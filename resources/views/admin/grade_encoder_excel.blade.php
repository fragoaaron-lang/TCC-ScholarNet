<div class="card shadow">
    <div class="card-header">
        Grade Encoder
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            @foreach($students as $student)
                <tr>

                    <form action="{{ route('admin.grades.store') }}" method="POST">
                        @csrf

                        <td>
                            {{ $student->name }}
                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                        </td>

                        <td>
                            <input type="text" name="subject" class="form-control" required>
                        </td>

                        <td>
                            <input type="number" step="0.01" name="grade" class="form-control" required>
                        </td>

                        <td>
                            <button class="btn btn-primary btn-sm">
                                Save
                            </button>
                        </td>

                    </form>

                </tr>
            @endforeach

            </tbody>

        </table>

    </div>
</div>
