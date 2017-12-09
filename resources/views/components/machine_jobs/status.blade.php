@if ($job->completed)
<div class="info-box bg-green">
@else
<div class="info-box bg-aqua">
@endif
    <span class="info-box-icon">
        @include('components.machine_jobs.icon', ['job' => $job, 'showText' => false])
    </span>
    <div class="info-box-content">
        <span class="info-box-text">Time remaining</span>
        <span class="info-box-number">
            @if ($job->completed)
                Completed
            @else
                @duration($job->states->first()->seconds_remaining)
            @endif
        </span>
        <div class="progress">
            <div class="progress-bar" style="width: {{round((100/$job->duration)*$job->states->first()->seconds_remaining) }}%"></div>
        </div>
        <span class="progress-description">Duration: @duration($job->duration)</span>
    </div>
    <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
