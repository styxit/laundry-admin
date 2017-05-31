<span>
    @if ($job->completed)
        <i class="fa fa-check-circle-o text-green"></i>
    @else
        <i class="fa fa-circle-o-notch fa-spin"></i>
    @endif

    @if ($showText === true && $job->completed)
        <span class="text-green">Completed</span>
    @elseif ($showText === true && !$job->completed)
        <span>Running</span>
    @endif
</span>
