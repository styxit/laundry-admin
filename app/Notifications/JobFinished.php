<?php

namespace App\Notifications;

use App\MachineJob;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Pushover\PushoverChannel;
use NotificationChannels\Pushover\PushoverMessage;

class JobFinished extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var MachineJob The MachineJob that has finished.
     */
    private $machineJob;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(MachineJob $machineJob)
    {
        $this->machineJob = $machineJob;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if ($notifiable instanceof User) {
            return ! empty($notifiable->pushover_user_key) ? [PushoverChannel::class] : ['mail'];
        }

        return [];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hi! 👋')
            ->subject('Laundry is done')
            ->line($this->getNotificationMessage())
            ->action(
                'View job details',
                route('machine_job.show', [$this->machineJob->id])
            );
    }

    /**
     * Get the Pushover representation of the notification.
     *
     * @param $notifiable
     *
     * @return PushoverMessage
     */
    public function toPushover($notifiable)
    {
        return PushoverMessage::create($this->getNotificationMessage())
            ->title('Laundry is done')
            ->url(
                route('machine_job.show', [$this->machineJob->id]),
                'View job details'
            );
    }

    /**
     * Construct the notification message.
     *
     * @return string The main message to send.
     */
    private function getNotificationMessage()
    {
        return sprintf(
            'Your laundry job has finished. It took %s.',
            $this->formatDuration($this->machineJob->duration)
        );
    }

    /**
     * Format a duration in seconds to a human readable string.
     *
     * @param int $seconds The number of seconds to format.
     *
     * @return string The human readable representation of $seconds.
     */
    private function formatDuration(int $seconds)
    {
        // Show hour and minute, unless $seconds is less than one minute.
        $format = ($seconds < 60) ? '0\m s\s' : 'G\h i\m';

        return Carbon::createFromTimestamp($seconds)->format($format);
    }
}
