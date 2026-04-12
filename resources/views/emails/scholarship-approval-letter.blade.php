<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scholarship Approval Letter</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .header { background-color: #218358; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .department { margin-bottom: 30px; border-bottom: 1px solid #eee; padding-bottom: 20px; }
        .department h3 { color: #218358; margin-bottom: 10px; }
        .student { margin-bottom: 10px; padding: 10px; background-color: #f9f9f9; border-radius: 5px; }
        .student strong { color: #218358; }
        .footer { background-color: #f5f5f5; padding: 20px; text-align: center; font-size: 12px; color: #666; }
        .stats { background-color: #e8f5e8; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Scholarship Approval Letter</h1>
        <p>{{ now()->format('F Y') }} Semester</p>
    </div>

    <div class="content">
        <p>Dear Acting President,</p>

        <p>I am pleased to submit the scholarship approval recommendations for the current semester. After careful review and evaluation by our department secretaries, the following students have been approved for scholarships.</p>

        <div class="stats">
            <h2>Summary</h2>
            <p><strong>Total Approved {{ ucfirst($type) }}:</strong> {{ $totalApproved }}</p>
            <p><strong>Departments with Approved {{ ucfirst($type) }}:</strong> {{ count($approvedApplicationsByDepartment) }}</p>
        </div>

        @foreach($approvedApplicationsByDepartment as $department => $items)
        <div class="department">
            <h3>{{ $department }}</h3>
            <p><strong>Approved {{ ucfirst($type) }}: {{ $items->count() }}</strong></p>

            @foreach($items as $item)
            <div class="student">
                @if($type === 'applications')
                    <strong>{{ $item->student ? $item->student->first_name . ' ' . $item->student->last_name : 'N/A' }}</strong><br>
                    Student ID: {{ $item->student ? $item->student->student_number : 'N/A' }}<br>
                    Scholarship: {{ $item->scholarship_name ?? 'N/A' }}<br>
                    Year Level: {{ $item->year_level }}<br>
                    GPA: {{ $item->gpa ?? 'N/A' }}<br>
                    Email: {{ $item->student ? $item->student->email : 'N/A' }}<br>
                    Submitted: {{ $item->created_at->format('M d, Y') }}
                @else
                    <strong>{{ $item->first_name }} {{ $item->last_name }}</strong><br>
                    Student ID: {{ $item->student_number }}<br>
                    Year Level: {{ $item->year_level }}<br>
                    Email: {{ $item->email }}
                @endif
            </div>
            @endforeach
        </div>
        @endforeach

        <p>These students have met all the necessary requirements and demonstrated academic excellence. The scholarships will provide crucial financial support to help them continue their education.</p>

        <p>Please review and approve these scholarship recommendations at your earliest convenience.</p>

        <p>Best regards,<br>
        <strong>{{ $admin->first_name }} {{ $admin->last_name }}</strong><br>
        Scholarship Program Administrator<br>
        {{ now()->format('F d, Y') }}</p>
    </div>

    <div class="footer">
        <p>This is an automated message from the Scholarship Management System.</p>
    </div>
</body>
</html>
