<div class="info-box machine-job-timer">
    <span class="info-box-icon bg-blue"><i class="fa fa-clock-o"></i></span>
    <div class="info-box-content">
        <span class="info-box-text">Started</span>
        <span class="info-box-number">
            {{ $job->created_at->format('G:i') }}
            <span class="small">{{ $job->created_at->format('d-m-Y') }}</span>
        </span>
        <span class="info-box-text">Estimated finish time</span>
        <span class="info-box-number">
            {{ $job->created_at->addSeconds($job->duration)->format('G:i') }}
            <span class="small">{{ $job->created_at->addSeconds($job->duration)->format('d-m-Y') }}</span>
        </span>
    </div>
    <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
