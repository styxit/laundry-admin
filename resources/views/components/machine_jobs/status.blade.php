@if ($job->completed)
<div class="info-box bg-green">
@else
<div class="info-box bg-aqua">
@endif
    <span class="info-box-icon">
        @if ($job->completed)
        <i class="fa fa-check-circle-o"></i>
        @else
        <i class="fa fa-circle-o-notch fa-spin"></i>
        @endif
    </span>
    <div class="info-box-content">
        <span class="info-box-text">Time remaining</span>
        <span class="info-box-number">
            @if ($job->completed)
            Completed
            @else
            {{ $job->states->first()->seconds_remaining->format('G\h i\m') }}
            @endif
        </span>
        <div class="progress">
            <div class="progress-bar" style="width: {{round((100/$job->duration->timestamp)*$job->states->first()->seconds_remaining->timestamp)}}%"></div>
        </div>
        <span class="progress-description">Duration: {{ $job->duration->format('G\h i\m') }}</span>
    </div>
    <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
