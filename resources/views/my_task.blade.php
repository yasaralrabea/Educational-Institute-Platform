{{-- resources/views/show_task.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>عرض الواجب -  </title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family:"Cairo",sans-serif; background:#eef2f7; color:#333; line-height:1.6; }

        /* الهيدر */
        header {
            background: linear-gradient(90deg,#253b5cff,#253b5cff);
            color:#fff;
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:20px 25px;
            box-shadow:0 4px 20px rgba(0,0,0,0.15);
            position:sticky;
            top:0;
            z-index:900;
            min-height:70px;
            flex-wrap:nowrap;
        }
        header h1 {
            font-size:26px;
            font-weight:700;
            text-align:center;
            flex:1 1 auto;
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
        }
        header .actions {
            display:flex;
            gap:12px;
            align-items:center;
            flex-shrink:0;
            z-index:1001;
        }
        header .actions a, header .actions button {
            background:rgba(255,255,255,0.15);
            border:none;
            color:#fff;
            cursor:pointer;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:10px 12px;
            border-radius:8px;
            transition:all 0.3s ease;
        }
        header .actions a:hover, header .actions button:hover { background:rgba(255,255,255,0.3); }
        header .actions svg { width:24px; height:24px; }

        /* زر القائمة */
        .menu-btn {
            position: fixed;
            top:22px;
            right:22px;
                  background: #253b5cff;
;
            color:#fff;
            border:none;
            border-radius:12px;
            padding:10px 15px;
            box-shadow:0 4px 12px rgba(0,0,0,0.25);
            cursor:pointer;
            transition: background 0.3s, transform 0.2s;
            z-index:1100;
        }
        .menu-btn svg { width:24px; height:24px; }
        .menu-btn:hover { background:#2563eb; transform: translateY(-1px); }

        /* القائمة الجانبية */
        .sidebar {
            position:fixed;
            top:0;
            right:-280px;
            width:280px;
            height:100%;
                  background: #253b5cff;
;
            color:#fff;
            padding:25px 20px;
            box-shadow:-4px 0 20px rgba(0,0,0,0.3);
            transition:right 0.4s ease;
            z-index:1000;
            border-radius:8px 0 0 8px;
            overflow-y:auto;
        }
        .sidebar.open { right:0; }
        .sidebar h2 {
            margin-bottom:25px;
            font-size:18px;
            font-weight:700;
            border-bottom:1px solid rgba(255,255,255,0.2);
            padding-bottom:10px;
            text-align:center;
        }
        .sidebar a {
            display:flex;
            align-items:center;
            gap:12px;
            color:#fff;
            text-decoration:none;
            margin-bottom:16px;
            font-size:16px;
            font-weight:600;
            padding:14px 18px;
            border-radius:12px;
            background:#2d3748;
            box-shadow:0 4px 12px rgba(0,0,0,0.25);
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
                  background: #253b5cff;
;
            transform:translateY(-2px);
            box-shadow:0 6px 16px rgba(0,0,0,0.35);
        }
        .close-btn {
            position:absolute;
            top:20px;
            left:20px;
            background:transparent;
            border:none;
            color:#fff;
            font-size:26px;
            cursor:pointer;
        }

        /* المحتوى */
        main { max-width:900px; margin:30px auto; padding:20px; }

        .card {
            background:#fff; border-radius:16px; padding:22px;
            box-shadow:0 10px 30px rgba(11,35,71,0.06);
            margin-bottom: 20px;
        }
        h2 { font-size:20px; color:#253b5cff; margin-bottom:14px; font-weight:700; }
        .status { margin-bottom:18px; font-weight:600; color:#374151; }

        .btn {
                  background: #253b5cff;
; color:#fff;
            padding:10px 18px; border-radius:8px;
            text-decoration:none; font-weight:600;
            display:inline-block; transition: all 0.3s ease;
        }
        .btn:hover { background:#2563eb; }

        form label { display:block; margin-bottom:6px; font-weight:600; }
        form input, form textarea {
            width:100%; padding:10px; margin-bottom:14px;
            border-radius:8px; border:1px solid #d1d5db;
            font-family:"Cairo",sans-serif;
        }
        form button { border:none; cursor:pointer; }

        .alert-success {
            padding:12px 18px; background:#ecfdf5; color:#065f46;
            border-radius:10px; box-shadow:0 6px 16px rgba(6,95,70,.06);
            margin-bottom:20px;
        }

        /* responsive */
        @media(max-width:720px) {
            header h1 { font-size:18px; }
            header .actions a, header .actions button { padding:5px 6px; }
            .menu-btn{
                top:50%;
                right:0;
                transform:translateY(-50%);
                width:36px; height:36px; padding:0; border-radius:50%;
                background: rgba(59,130,246,0.7);
            }
            .menu-btn svg{width:20px; height:20px; stroke-width:2;}
        }
    </style>
</head>
<body>

<!-- زر القائمة -->
<button class="menu-btn" id="menuBtn" onclick="toggleSidebar()">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
  </svg>
</button>

<!-- الهيدر -->
<header>
    <h1> </h1>
    <div class="actions">
        <a href="{{ route('my.profile') }}" title="حسابي">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                 stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" title="تسجيل خروج">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2v-1m0-10V5a2 2 0 012-2h4a2 2 0 012 2v1"/>
                </svg>
            </button>
        </form>
    </div>
</header>

<!-- القائمة الجانبية -->
<div class="sidebar" id="sidebar">
    <h2>القائمة</h2>
    <button class="close-btn" onclick="toggleSidebar()">×</button>
    <a href="{{ route('home') }}">الرئيسية</a>
    <a href="{{ route('my.absences') }}">غياباتي</a>
    <a href="{{ route('my.profile') }}">ملفي الشخصي</a>
    <a href="{{ route('my.calendar') }}">التقويم</a>
    <a href="{{ route('my.plan') }}">خطتي</a>
    <a href="{{ route('s_index') }}">مهامي</a>
</div>

<!-- محتوى الصفحة -->
<main>
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

   <div class="card">
    <h2>الواجب: {{ $task->subject }}</h2>
    <div class="status">
        الحالة:
        @if($task)
            <strong>تم التسليم</strong><br>
            التقييم: {{ $rate>rate ?? 'لم يتم التصحيح بعد' }}<br>

            {{-- عرض الرابط إذا موجود --}}
            @if($task->url)
                رابط الواجب: <a href="{{ $task->url }}" target="_blank">{{ $task->url }}</a><br>
            @endif

            {{-- عرض الملف إذا موجود --}}
            @if($task->file)
                الملف المرفوع: <a href="{{ asset('storage/' . $task->file) }}" target="_blank">تحميل الملف</a>
            @endif

        @else
            <strong>لم يتم التسليم</strong>
        @endif
    </div>
    <a href="{{ route('s_index') }}" class="btn">العودة للواجبات</a>
</div>


    <div class="card">
        <h2>تسليم الواجب</h2>
        <form action="{{ route('task_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            <label>ملاحظات الطالب</label>
            <textarea name="submission" rows="4">{{ old('submission', $rate->submission ?? '') }}</textarea>
            <label>رابط الواجب (اختياري)</label>
            <input type="url" name="url" value="{{ old('url', $rate->url ?? '') }}">
            <label>رفع ملف (اختياري)</label>
            <input type="file" name="file">
            <button type="submit" class="btn">تسليم الواجب</button>
        </form>
    </div>
</main>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const menuBtn = document.getElementById("menuBtn");
    sidebar.classList.toggle("open");
    menuBtn.style.display = sidebar.classList.contains("open") ? "none" : "block";
}
</script>

</body>
</html>
