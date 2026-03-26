{{-- resources/views/requirements/pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Scholarship Application Letter</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            line-height: 1.5;
            font-size: 12pt;
            margin: 50px;
        }
        .header {
            margin-bottom: 30px;
        }
        .header p {
            margin: 0;
        }
        .letter-body {
            margin-top: 20px;
            margin-bottom: 50px;
        }
        .signature {
            margin-top: 60px;
        }
    </style>
</head>
<body>

    <div class="header">
        <p>To the Registrar</p>
        <p>Tomas Claudio Colleges</p>
        <p>Taghangin, Morong, Rizal</p>
        <p>Date: {{ date('F d, Y') }}</p>
    </div>

    <div class="letter-body">
        <p>To Whom It May Concern,</p>

        <p>
            I am writing to express my interest in the <strong>{{ $requirement->scholarship_name }}</strong>
            offered by <strong>{{ $requirement->sponsor }}</strong>.
            As a dedicated and hardworking student with a strong academic record and a commitment to my community,
            I am eager to pursue higher education with the support of your esteemed scholarship.
        </p>

        <p>
            Currently, I am a <strong>{{ $requirement->year_level }}</strong> at Tomas Claudio Colleges,
            where I have maintained a GPA of <strong>{{ $requirement->gpa }}</strong>.
            The scholarship will significantly alleviate the financial burden of my education,
            allowing me to focus more on my studies and extracurricular activities.
            With the support of this scholarship, I plan to
            <strong>{{ $requirement->plan }}</strong>.
        </p>

        <p>
            I am grateful for your consideration and the opportunity to apply for this scholarship.
            Thank you for your time and support.
        </p>
    </div>

    <div class="signature">
        <p>Sincerely,</p>
        <p><strong>{{ auth()->user()->name }}</strong></p>
    </div>

</body>
</html>
