<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>عرض الواجب</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Fonts: smoother Arabic -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">

  <style>
    :root{
      /* Calm modern palette */
      --bg:#f6f7fb;
      --card: rgba(255,255,255,.72);
      --card-solid:#ffffff;

      --text:#0f172a;
      --muted:#64748b;
      --border: rgba(15,23,42,.08);

      --primary:#1f2f48;
      --primary-2:#2563eb;

      --danger:#ef4444;
      --success:#16a34a;

      --shadow: 0 10px 24px rgba(15,23,42,.08);
      --shadow-sm: 0 6px 16px rgba(15,23,42,.06);

      --radius: 18px;
      --radius-sm: 14px;
    }

    *{margin:0;padding:0;box-sizing:border-box;}
    html{ scroll-behavior:smooth; }
    body{
      font-family:"Tajawal","Cairo",system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;
      background:var(--bg);
      color:var(--text);
      line-height:1.75;
      min-height:100vh;
      text-rendering:optimizeLegibility;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
    }
    a{color:inherit;text-decoration:none;}
    button{font-family:inherit;}
    .container{
      width:min(1200px, calc(100% - 32px));
      margin-inline:auto;
    }

    /* Background (calmer) */
    .background{
      position:fixed;
      inset:0;
      background:
        radial-gradient(1000px 420px at 10% 0%, rgba(37,99,235,.10), transparent 55%),
        radial-gradient(900px 360px at 92% 6%, rgba(56,189,248,.10), transparent 62%),
        radial-gradient(900px 420px at 50% 110%, rgba(99,102,241,.07), transparent 60%),
        linear-gradient(180deg, #fbfcff 0%, #f6f7fb 55%, #f6f7fb 100%);
      z-index:-2;
    }

    /* ===== Header ===== */
    header{
      position: sticky;
      top: 0;
      z-index: 900;
      background: rgba(31,47,72,.88);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      color:#fff;
      border-bottom: 1px solid rgba(255,255,255,.10);
      box-shadow: 0 10px 22px rgba(0,0,0,.10);
    }
    .header-inner{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:16px;
      padding: 12px 0;
      min-height: 66px;
    }
    .header-title{
      display:flex;
      align-items:center;
      gap:10px;
      font-weight:800;
      font-size:20px;
      text-align:center;
      margin:0 auto;
      white-space:nowrap;
      overflow:hidden;
      text-overflow:ellipsis;
      max-width: 70vw;
      letter-spacing:.2px;
    }
    .badge{
      font-size: 12px;
      font-weight: 700;
      padding: 4px 10px;
      border-radius: 999px;
      background: rgba(255,255,255,.12);
      border: 1px solid rgba(255,255,255,.14);
      color: rgba(255,255,255,.92);
    }
    .header-actions{
      display:flex;
      gap:10px;
      align-items:center;
      flex-shrink:0;
    }
    .icon-btn{
      background: rgba(255,255,255,.10);
      border: 1px solid rgba(255,255,255,.14);
      color:#fff;
      cursor:pointer;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      width:42px;
      height:42px;
      border-radius: var(--radius-sm);
      transition:.18s ease;
      outline:none;
    }
    .icon-btn:hover{ background: rgba(255,255,255,.16); transform: translateY(-1px); }
    .icon-btn:focus-visible{ box-shadow: 0 0 0 3px rgba(37,99,235,.35); }
    .icon-btn svg{ width:22px;height:22px; }

    /* ===== Menu Button ===== */
    .menu-btn{
      position: fixed;
      top: 16px;
      right: 16px;
      z-index: 1100;
      width:46px;
      height:46px;
      border:none;
      border-radius: 16px;
      cursor:pointer;
      background: rgba(31,47,72,.32);
      border: 1px solid rgba(255,255,255,.16);
      color:#fff;
      box-shadow: 0 12px 22px rgba(0,0,0,.16);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      transition: .18s ease;
      display:flex;
      align-items:center;
      justify-content:center;
    }
    .menu-btn:hover{ background: rgba(31,47,72,.40); transform: translateY(-1px); }
    .menu-btn svg{ width:26px; height:26px; }

    /* ===== Sidebar + Overlay ===== */
    .overlay{
      position: fixed;
      inset:0;
      background: rgba(2,6,23,.42);
      z-index: 1000;
      display:none;
      backdrop-filter: blur(2px);
      -webkit-backdrop-filter: blur(2px);
    }
    .overlay.open{ display:block; }

    .sidebar{
      position: fixed;
      top: 0;
      right: -340px;
      width: 310px;
      max-width: calc(100% - 48px);
      height: 100%;
      background: rgba(31,47,72,.92);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      color:#fff;
      padding: 18px;
      box-shadow: -14px 0 34px rgba(0,0,0,.28);
      transition: right .28s ease;
      z-index: 1101;
      border-radius: 22px 0 0 22px;
      overflow:auto;
      border-left: 1px solid rgba(255,255,255,.10);
    }
    .sidebar.open{ right: 0; }

    .sidebar-header{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      margin-bottom: 16px;
      padding-bottom: 12px;
      border-bottom: 1px solid rgba(255,255,255,.12);
    }
    .sidebar-title{ font-size:18px; font-weight:800; }
    .close-sidebar{
      width:42px;height:42px;
      border-radius: var(--radius-sm);
      border: 1px solid rgba(255,255,255,.16);
      background: rgba(255,255,255,.08);
      color:#fff;
      cursor:pointer;
      transition:.18s ease;
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:22px;
      line-height:1;
    }
    .close-sidebar:hover{ background: rgba(255,255,255,.14); }

    .sidebar a{
      display:flex;
      align-items:center;
      gap:12px;
      padding: 12px 12px;
      border-radius: 16px;
      text-decoration:none;
      color:#fff;
      background: rgba(255,255,255,.06);
      border: 1px solid rgba(255,255,255,.10);
      margin-bottom: 10px;
      transition:.18s ease;
    }
    .sidebar a:hover{
      background: rgba(255,255,255,.12);
      transform: translateX(-2px);
    }
    .sidebar a.active{
      background: rgba(37,99,235,.20);
      border-color: rgba(37,99,235,.28);
    }

    /* ===== Main ===== */
    main{ padding: 18px 0 60px; }

    .hero{
      margin-top: 18px;
      border-radius: var(--radius);
      padding: 18px;
      background: linear-gradient(135deg, rgba(37,99,235,.14), rgba(99,102,241,.10));
      border: 1px solid rgba(255,255,255,.32);
      box-shadow: var(--shadow);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
    }
    .hero-top{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap:12px;
      flex-wrap:wrap;
    }
    .hero-title{
      color:#fff;
      font-weight:800;
      font-size: 20px;
      letter-spacing:.2px;
    }
    .hero-sub{
      color: rgba(255,255,255,.85);
      font-size: 14px;
      margin-top: 6px;
      max-width: 70ch;
      font-weight:500;
    }
    .hero-actions{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      align-items:center;
      justify-content:flex-end;
      flex: 1 1 auto;
    }

    /* Cards */
    .card{
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 16px;
      margin-top: 14px;
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
    }

    /* Buttons (calmer) */
    .btn{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      gap:8px;
      padding: 10px 14px;
      border-radius: var(--radius-sm);
      border: 1px solid transparent;
      cursor:pointer;
      font-weight: 700;
      font-size: 14px;
      transition:.18s ease;
      text-decoration:none;
      white-space:nowrap;
      user-select:none;
    }
    .btn:focus-visible{ box-shadow: 0 0 0 3px rgba(37,99,235,.22); outline:none; }

    .btn-primary{ background: rgba(37,99,235,.95); color:#fff; }
    .btn-primary:hover{ transform: translateY(-1px); filter: brightness(.98); }

    .btn-danger{ background: rgba(239,68,68,.95); color:#fff; }
    .btn-danger:hover{ transform: translateY(-1px); filter: brightness(.98); }

    .btn-success{ background: rgba(22,163,74,.95); color:#fff; }
    .btn-success:hover{ transform: translateY(-1px); filter: brightness(.98); }

    .btn-outline{
      background: rgba(255,255,255,.85);
      border-color: rgba(15,23,42,.10);
      color: var(--text);
    }
    .btn-outline:hover{ background: rgba(255,255,255,.95); transform: translateY(-1px); }

    .row-actions{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      align-items:center;
    }

    /* Status pill (softer) */
    .pill{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      padding: 6px 10px;
      border-radius: 999px;
      font-weight: 700;
      font-size: 12px;
      border: 1px solid rgba(15,23,42,.10);
      background: rgba(248,250,252,.85);
      color: #334155;
    }
    .pill-open{
      border-color: rgba(22,163,74,.22);
      background: rgba(22,163,74,.10);
      color: #166534;
    }
    .pill-closed{
      border-color: rgba(239,68,68,.22);
      background: rgba(239,68,68,.10);
      color: #991b1b;
    }

    /* Form */
    .grid{
      display:grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 12px;
      margin-top: 10px;
    }
    .field{
      display:flex;
      flex-direction:column;
      gap:6px;
      min-width: 0;
    }
    label{
      font-weight: 800;
      color:#334155;
      font-size: 13px;
      letter-spacing:.1px;
    }
    input{
      width:100%;
      padding: 11px 12px;
      border-radius: var(--radius-sm);
      border: 1px solid rgba(15,23,42,.12);
      font-size: 14px;
      background: rgba(255,255,255,.92);
      transition:.18s ease;
      outline:none;
    }
    input:focus{
      border-color: rgba(37,99,235,.45);
      box-shadow: 0 0 0 3px rgba(37,99,235,.16);
      background:#fff;
    }
    .hint{
      font-size: 12px;
      color: var(--muted);
      font-weight: 600;
      margin-top: 4px;
    }
    .file-row{
      display:flex;
      gap:10px;
      align-items:center;
      flex-wrap:wrap;
      margin-top: 8px;
    }

    /* Table (cleaner) */
    .table-wrap{ overflow:auto; margin-top: 12px; }
    table{
      width:100%;
      border-collapse: separate;
      border-spacing: 0 10px;
      min-width: 720px;
    }
    thead th{
      position: sticky;
      top: 0;
      z-index: 2;
      background: rgba(241,245,249,.90);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      color: rgba(31,47,72,.95);
      font-weight: 800;
      padding: 12px 14px;
      font-size: 13px;
      text-align:center;
      border-top: 1px solid rgba(15,23,42,.08);
      border-bottom: 1px solid rgba(15,23,42,.08);
    }
    tbody td{
      background: rgba(255,255,255,.92);
      padding: 12px 14px;
      text-align:center;
      border-radius: var(--radius-sm);
      border: 1px solid rgba(15,23,42,.08);
      box-shadow: 0 2px 10px rgba(15,23,42,.04);
      font-size: 14px;
      vertical-align: middle;
    }

    /* Responsive */
    @media (max-width: 820px){
      .header-title{ font-size: 19px; }
      .menu-btn{ top: 14px; right: 14px; }
      .grid{ grid-template-columns: 1fr; }
      table{ min-width: 820px; }
    }

    @media (max-width: 640px){
      .container{ width: calc(100% - 24px); }
      .header-title{ margin:0; max-width: 64vw; }

      /* table -> cards */
      .table-wrap{ overflow: visible; }
      table{ min-width: unset; border-spacing: 0; }
      thead{ display:none; }

      tbody, tr, td{ display:block; width:100%; }
      tbody tr{
        background: rgba(255,255,255,.92);
        border: 1px solid rgba(15,23,42,.08);
        border-radius: var(--radius);
        padding: 10px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 12px;
      }
      tbody td{
        border:none;
        box-shadow:none;
        text-align:right;
        padding: 8px 8px;
        border-radius: 0;
        display:flex;
        justify-content:space-between;
        gap:12px;
      }
      tbody td::before{
        content: attr(data-label);
        font-weight: 800;
        color:#334155;
      }
    }

    @media (prefers-reduced-motion: reduce){
      *{ transition:none !important; }
      html{ scroll-behavior:auto; }
    }
  </style>
</head>

<body>
  <div class="background"></div>

  <!-- زر القائمة -->
  <button class="menu-btn" type="button" aria-label="فتح القائمة" onclick="toggleSidebar()">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
  </button>

  <!-- الهيدر -->
  <header>
    <div class="container header-inner">
      <div style="width:46px; height:46px; flex-shrink:0;"></div>

      <h1 class="header-title">
        عرض الواجب
        <span class="badge">تفاصيل</span>
      </h1>

      <div class="header-actions">
        <a class="icon-btn" href="{{ route('my.profile') }}" title="حسابي" aria-label="حسابي">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </a>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="icon-btn" type="submit" title="تسجيل خروج" aria-label="تسجيل خروج">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2v-1m0-10V5a2 2 0 012-2h4a2 2 0 012 2v1"/>
            </svg>
          </button>
        </form>
      </div>
    </div>
  </header>

  <!-- Overlay -->
  <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar" aria-label="القائمة الجانبية">
    <div class="sidebar-header">
      <div class="sidebar-title">القائمة</div>
      <button class="close-sidebar" type="button" aria-label="إغلاق" onclick="closeSidebar()">×</button>
    </div>

    <a class="active" href="{{ route('tasks.index') }}">الواجبات</a>
    <a href="{{ route('plans.index') }}">الخطط</a>
    <a href="{{ route('students.index') }}">الطلاب</a>
    <a href="{{ route('teachers.index') }}">المعلمين</a>
    <a href="{{ route('absences.index') }}">الغيابات</a>
    <a href="{{ route('calendars.index') }}">التقويم</a>
    <a href="{{ route('control_page') }}">الرئيسية</a>
  </aside>

  <main class="container">
    <!-- HERO -->
    <section class="hero">
      <div class="hero-top">
        <div>
          <div class="hero-title">{{ $task->subject ?? 'الواجب' }}</div>
          <div class="hero-sub"></div>
        </div>

        <div class="hero-actions">
          @if($task->condition == 'open')
            <span class="pill pill-open">الحالة: مفتوح</span>
          @else
            <span class="pill pill-closed">الحالة: مغلق</span>
          @endif
        </div>
      </div>
    </section>

    <!-- Actions Card -->
    <div class="card">
      <div class="row-actions">
        @if($task->condition == 'open')
          <a href="{{ route('tasks.close', $task->id) }}" class="btn btn-danger">إغلاق الواجب</a>
        @else
          <a href="{{ route('tasks.open', $task->id) }}" class="btn btn-success">فتح الواجب</a>
        @endif

        <a href="{{ route('tasks.index') }}" class="btn btn-outline">العودة للواجبات</a>

        <form action="{{ route('task.destroy', $task->id) }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
            حذف الواجب
          </button>
        </form>
      </div>
    </div>

    <!-- Edit Card -->
    <div class="card">
      <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
        <div style="font-weight:800; color:var(--primary); font-size:18px;">تعديل الواجب</div>
        <span class="pill">تحديث البيانات</span>
      </div>

      <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data" style="margin-top:10px;">
        @csrf
        @method('PUT')

        <div class="grid">
          <div class="field">
            <label>المادة / العنوان</label>
            <input type="text" name="subject" value="{{ old('subject', $task->subject) }}" required>
          </div>

          <div class="field">
            <label>الرابط</label>
            <input type="url" name="url" value="{{ old('url', $task->url) }}" placeholder="اختياري">
            <div class="hint">ضع رابط Google Drive أو أي رابط متعلق بالواجب.</div>
          </div>

          <div class="field">
            <label>مفتوح للطلاب حتى</label>
            <input type="date" name="open_to" value="{{ old('open_to', $task->open_to) }}" required>
          </div>

          <div class="field">
            <label>ملف الواجب</label>
            <input type="file" name="file">
            <div class="hint">اختياري — يمكن رفع PDF / صورة / Word…</div>
          </div>
        </div>

        @if($task->file_path)
          <div class="file-row">
            <span class="pill">ملف حالي</span>
            <a class="btn btn-outline" href="{{ asset('storage/' . $task->file_path) }}" target="_blank" rel="noopener">
              تحميل الملف
            </a>
          </div>
        @endif

        <div style="margin-top:12px;">
          <button type="submit" class="btn btn-primary">💾 تحديث الواجب</button>
        </div>
      </form>
    </div>

    <!-- Submissions -->
    <div class="card">
      <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
        <div style="font-weight:800; color:var(--primary); font-size:18px;">📂 التسليمات</div>
        <span class="pill">{{ $task->submissions ? $task->submissions->count() : 0 }} تسليم</span>
      </div>

      @if($task->submissions && $task->submissions->count())
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>اسم الطالب</th>
                <th>الإجراء</th>
              </tr>
            </thead>
            <tbody>
              @foreach($task->submissions as $submission)
                <tr>
                  <td data-label="اسم الطالب">{{ $submission->user->name ?? 'غير معروف' }}</td>
                  <td data-label="الإجراء">
                    <a href="{{ route('submission.show',$submission->id) }}" class="btn btn-primary">🔗 زيارة التسليم</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div style="margin-top:12px; color:var(--muted); font-weight:700;">
          لا توجد تسليمات حتى الآن.
        </div>
      @endif
    </div>
  </main>

  <script>
    function lockScroll(lock){
      document.body.style.overflow = lock ? 'hidden' : '';
    }

    function toggleSidebar(){
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('overlay');
      const isOpen = sidebar.classList.toggle('open');
      overlay.classList.toggle('open', isOpen);
      lockScroll(isOpen);
    }

    function closeSidebar(){
      document.getElementById('sidebar').classList.remove('open');
      document.getElementById('overlay').classList.remove('open');
      lockScroll(false);
    }

    document.addEventListener('keydown', (e) => {
      if(e.key === 'Escape'){
        closeSidebar();
      }
    });
  </script>
</body>
</html>