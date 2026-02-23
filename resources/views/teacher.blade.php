<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تفاصيل المعلم</title>

  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: "Cairo", sans-serif;
      background: #f9fafb;
      margin: 0;
      padding: 20px;
    }

    .card {
      background: #fff;
      border-radius: 14px;
      padding: 24px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: auto;
    }

    h2 { margin-top: 0; color: #2759a4ff; }

    p {
      margin: 8px 0;
      font-size: 16px;
      word-wrap: break-word;
    }

    /* الأزرار */
    .actions {
      margin-top: 20px;
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .btn {
      padding: 10px 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      font-size: 14px;
      transition: 0.2s;
      color: #fff;
      flex: 1;
      min-width: 120px;
    }

    .btn-edit { background: #2563eb; }
    .btn-edit:hover { background: #1d4ed8; }

    .btn-delete { background: #dc2626; }
    .btn-delete:hover { background: #b91c1c; }

    .btn-promote { background: #f59e0b; }
    .btn-promote:hover { background: #d97706; }

    .btn-demote { background: #6b7280; }
    .btn-demote:hover { background: #4b5563; }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
      padding: 15px;
    }

    .modal-content {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      width: 100%;
      max-width: 500px;
      max-height: 90vh;
      overflow-y: auto;
    }

    .modal-content h3 { margin-top: 0; color: #2759a4ff; }

    .modal-content label {
      display: block;
      margin-top: 10px;
      font-weight: 600;
    }

    .modal-content input {
      width: 100%;
      padding: 10px;
      margin-top: 4px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 16px;
    }

    .modal-content button {
      margin-top: 16px;
      padding: 12px;
      border: none;
      border-radius: 8px;
      background: #2563eb;
      color: #fff;
      font-weight: 600;
      cursor: pointer;
      width: 100%;
    }

    /* 📱 تحسين الجوال */
    @media (max-width: 600px) {
      body { padding: 10px; }

      .card {
        padding: 18px;
        border-radius: 12px;
      }

      h2 { font-size: 20px; }

      p { font-size: 15px; }

      .actions {
        flex-direction: column;
      }

      .btn {
        width: 100%;
        font-size: 15px;
      }
    }
  </style>
</head>
<body>

<div class="card">
  <h2>تفاصيل المعلم: {{ $teacher->name }}</h2>

  <p><strong>البريد:</strong> {{ $teacher->user->email ?? '-' }}</p>
  <p><strong>الوظيفة:</strong> {{ $teacher->position }}</p>
  <p><strong>الهاتف:</strong> {{ $teacher->phone }}</p>
  <p><strong>المؤهل:</strong> {{ $teacher->qualification }}</p>
  <p><strong>الراتب:</strong> {{ $teacher->salary }}</p>

  <div class="actions">
    <button class="btn btn-edit" onclick="openModal()">تعديل</button>

    <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-delete">حذف</button>
    </form>

    @if($teacher->user && $teacher->user->role === 'admin')
    <form action="{{ route('teachers.demote', $teacher->id) }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-demote">إزالة المشرف</button>
    </form>
    @else
    <form action="{{ route('teachers.promote', $teacher->id) }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-promote">ترقية لمشرف</button>
    </form>
    @endif
  </div>
</div>

<!-- Modal -->
<div class="modal" id="editModal">
  <div class="modal-content">
    <h3>تعديل بيانات المعلم</h3>

    <form method="POST" action="{{ route('teachers.update', $teacher->id) }}">
      @csrf
      @method('PUT')

      <label>الاسم:</label>
      <input type="text" name="name" value="{{ $teacher->name }}" required>

      <label>البريد:</label>
      <input type="email" name="email" value="{{ $teacher->user->email }}" required>

      <label>الهاتف:</label>
      <input type="text" name="phone" value="{{ $teacher->phone }}" required>

      <label>الوظيفة:</label>
      <input type="text" name="position" value="{{ $teacher->position }}" required>

      <label>المؤهل:</label>
      <input type="text" name="qualification" value="{{ $teacher->qualification }}" required>

      <label>الراتب:</label>
      <input type="text" name="salary" value="{{ $teacher->salary }}" required>

      <button type="submit">حفظ التغييرات</button>
    </form>
  </div>
</div>

<script>
function openModal() {
  document.getElementById('editModal').style.display = 'flex';
}

window.onclick = function(e) {
  if (e.target == document.getElementById('editModal')) {
    document.getElementById('editModal').style.display = 'none';
  }
}
</script>

</body>
</html>