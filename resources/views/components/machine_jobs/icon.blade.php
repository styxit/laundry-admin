<span>
    @if ($showText === true && $job->completed)
        <span class="text-green"> <i class="fa fa-check-circle-o"></i> Completed</span>
    @elseif ($showText === true && !$job->completed)
        <span><i class="fa fa-circle-o-notch fa-spin"></i> Running</span>
    @elseif ($job->completed)
        <i class="fa fa-check-circle-o"></i>
    @else
        <i class="fa fa-circle-o-notch fa-spin"></i>
    @endif
</span>
