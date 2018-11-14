<div class="info-box machine-job-timer">
    <span class="info-box-icon bg-blue"><i class="fa fa-clock-o"></i></span>
    <div class="info-box-content">
        <span class="info-box-text">Started</span>
        <span class="info-box-number">
            @php
                // Determine job start time in user's timezone.
                $startTime = $job->created_at->timezone(Auth::user()->timezone);
            @endphp
            {{ $startTime->format('G:i') }}
            <span class="small hidden-md hidden-sm">{{ $startTime->format('d-m-Y') }}</span>
        </span>
        <span class="info-box-text">Estimated finish time</span>
        <span class="info-box-number">
            @php
                // Determine estimated job finish time in user's timezone.
                $finishTime = $startTime->addSeconds($job->duration);
            @endphp
            {{ $finishTime->format('G:i') }}
            <span class="small hidden-md hidden-sm">{{ $finishTime->format('d-m-Y') }}</span>
        </span>
    </div>
    <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
