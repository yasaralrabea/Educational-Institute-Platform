<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>ملف المعلم</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">

  <style>
    :root{
      --bg:#f3f6fb;
      --card:#ffffff;
      --text:#0f172a;
      --muted:#64748b;
      --border:#e5e7eb;

      --primary:#253b5c;
      --primary-dark:#1f2f48;
      --primary-2:#2563eb;

      --accent:#ffec1d;
      --danger:#ef4444;
      --success:#16a34a;

      --shadow: 0 12px 34px rgba(15,23,42,.10);
      --shadow-sm: 0 6px 18px rgba(15,23,42,.08);
      --radius: 20px;
    }

    *{margin:0;padding:0;box-sizing:border-box;}
    body{
      font-family:"Cairo",sans-serif;
      background:var(--bg);
      color:var(--text);
      line-height:1.65;
      min-height:100vh;
    }
    a{color:inherit;text-decoration:none;}
    button{font-family:inherit;}
    .container{
      width:min(1200px, calc(100% - 32px));
      margin-inline:auto;
    }

    /* Background */
    .background{
      position:fixed;
      inset:0;
      background:
        radial-gradient(1200px 420px at 12% 0%, rgba(37,99,235,.14), transparent 55%),
        radial-gradient(900px 360px at 92% 10%, rgba(255,236,29,.16), transparent 62%),
        radial-gradient(800px 320px at 40% 100%, rgba(37,99,235,.08), transparent 55%),
        #f8fafc;
      z-index:-2;
    }

    /* ===== Header ===== */
    header{
      position: sticky;
      top: 0;
      z-index: 900;
      background: linear-gradient(90deg, var(--primary), var(--primary-dark));
      color:#fff;
      box-shadow: 0 8px 30px rgba(0,0,0,.15);
    }
    .header-inner{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:16px;
      padding: 14px 0;
      min-height: 68px;
    }
    .header-title{
      display:flex;
      align-items:center;
      gap:10px;
      font-weight:900;
      font-size:22px;
      text-align:center;
      margin:0 auto;
      white-space:nowrap;
      overflow:hidden;
      text-overflow:ellipsis;
      max-width: 70vw;
    }
    .badge{
      font-size: 12px;
      font-weight: 900;
      padding: 4px 10px;
      border-radius: 999px;
      background: rgba(255,255,255,.14);
      border: 1px solid rgba(255,255,255,.18);
      color: rgba(255,255,255,.92);
    }
    .header-actions{
      display:flex;
      gap:10px;
      align-items:center;
      flex-shrink:0;
    }
    .icon-btn{
      background: rgba(255,255,255,.14);
      border: 1px solid rgba(255,255,255,.18);
      color:#fff;
      cursor:pointer;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      width:42px;
      height:42px;
      border-radius:14px;
      transition:.22s;
      outline:none;
    }
    .icon-btn:hover{ background: rgba(255,255,255,.24); transform: translateY(-1px); }
    .icon-btn svg{ width:22px;height:22px; }

    /* ===== Menu Button ===== */
    .menu-btn{
      position: fixed;
      top: 18px;
      right: 18px;
      z-index: 1100;
      width:46px;
      height:46px;
      border:none;
      border-radius: 16px;
      cursor:pointer;
      background: rgba(255,255,255,.14);
      border: 1px solid rgba(255,255,255,.18);
      color:#fff;
      box-shadow: 0 12px 26px rgba(0,0,0,.22);
      backdrop-filter: blur(10px);
      transition: .22s;
      display:flex;
      align-items:center;
      justify-content:center;
    }
    .menu-btn:hover{ background: rgba(255,255,255,.24); transform: translateY(-1px); }
    .menu-btn svg{ width:26px; height:26px; }

    /* ===== Sidebar + Overlay ===== */
    .overlay{
      position: fixed;
      inset:0;
      background: rgba(0,0,0,.45);
      z-index: 1000;
      display:none;
    }
    .overlay.open{ display:block; }

    .sidebar{
      position: fixed;
      top: 0;
      right: -340px;
      width: 310px;
      max-width: calc(100% - 48px);
      height: 100%;
      background: linear-gradient(180deg, var(--primary), var(--primary-dark));
      color:#fff;
      padding: 18px;
      box-shadow: -14px 0 34px rgba(0,0,0,.35);
      transition: right .32s ease;
      z-index: 1101;
      border-radius: 22px 0 0 22px;
      overflow:auto;
    }
    .sidebar.open{ right: 0; }

    .sidebar-header{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      margin-bottom: 16px;
      padding-bottom: 12px;
      border-bottom: 1px solid rgba(255,255,255,.14);
    }
    .sidebar-title{ font-size:18px; font-weight:900; }
    .close-sidebar{
      width:42px;height:42px;
      border-radius:14px;
      border: 1px solid rgba(255,255,255,.18);
      background: rgba(255,255,255,.10);
      color:#fff;
      cursor:pointer;
      transition:.2s;
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:22px;
      line-height:1;
    }
    .close-sidebar:hover{ background: rgba(255,255,255,.20); }

    .sidebar a{
      display:flex;
      align-items:center;
      gap:12px;
      padding: 12px 12px;
      border-radius: 16px;
      color:#fff;
      background: rgba(255,255,255,.08);
      border: 1px solid rgba(255,255,255,.10);
      margin-bottom: 10px;
      transition:.22s;
      font-weight: 900;
    }
    .sidebar a:hover{
      background: rgba(255,236,29,.92);
      color:#111827;
      transform: translateX(-2px);
    }

    /* ===== Main ===== */
    main{ padding: 18px 0 60px; }

    .hero{
      margin-top: 18px;
      border-radius: var(--radius);
      padding: 18px;
      background: linear-gradient(135deg, rgba(37,99,235,.18), rgba(255,236,29,.14));
      border: 1px solid rgba(255,255,255,.30);
      box-shadow: 0 18px 40px rgba(0,0,0,.10);
      backdrop-filter: blur(10px);
    }
    .hero-title{ color:#fff; font-weight:900; font-size:20px; }
    .hero-sub{ color: rgba(255,255,255,.88); font-size:14px; margin-top:6px; }

    .card{
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 16px;
      margin-top: 14px;
    }

    /* Desktop table */
    .table-wrap{ overflow:auto; }
    table{
      width:100%;
      border-collapse: separate;
      border-spacing: 0 10px;
      min-width: 980px;
    }
    thead th{
      position: sticky;
      top: 0;
      z-index: 2;
      background: #f1f5f9;
      color: var(--primary);
      font-weight: 900;
      padding: 12px 14px;
      font-size: 13px;
      text-align:center;
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
    }
    tbody td{
      background:#fff;
      padding: 12px 14px;
      text-align:center;
      border-radius: 14px;
      border: 1px solid var(--border);
      box-shadow: 0 2px 12px rgba(0,0,0,.04);
      font-size: 14px;
      vertical-align: middle;
    }

    /* Mobile profile cards (strong mobile UX) */
    .profile-grid{
      display:none;
      gap: 12px;
    }
    .info{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap: 12px;
      padding: 12px;
      border: 1px solid var(--border);
      border-radius: 18px;
      background: #fff;
      box-shadow: var(--shadow-sm);
    }
    .info b{
      display:block;
      font-weight: 900;
      color:#334155;
      font-size: 13px;
      margin-bottom: 4px;
    }
    .info span{
      display:block;
      font-weight: 900;
      color: var(--text);
      font-size: 15px;
      line-height: 1.55;
      word-break: break-word;
    }
    .copy-btn{
      width: 42px;
      height: 42px;
      border-radius: 14px;
      border: 1px solid var(--border);
      background: #fff;
      cursor: pointer;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      transition: .2s;
      flex-shrink:0;
    }
    .copy-btn:hover{ background:#f9fafb; transform: translateY(-1px); }
    .copy-btn svg{ width:18px;height:18px; color:#334155; }

    /* Mini toast (copy feedback) */
    .mini-toast{
      position: fixed;
      left: 18px;
      bottom: 18px;
      z-index: 1500;
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 16px;
      box-shadow: 0 18px 36px rgba(0,0,0,.18);
      padding: 10px 12px;
      font-weight: 900;
      display:none;
    }
    .mini-toast.show{ display:block; animation: pop .18s ease; }

    @keyframes pop{
      from{ opacity:0; transform: translateY(10px) scale(.985); }
      to{ opacity:1; transform: translateY(0) scale(1); }
    }

    /* Responsive tweaks */
    @media (max-width: 820px){
      .header-title{ font-size: 20px; }
      .menu-btn{ top: 14px; right: 14px; }
      table{ min-width: 860px; }
    }

    @media (max-width: 640px){
      .container{ width: calc(100% - 24px); }
      .header-inner{ padding: 12px 0; }
      .header-title{ margin:0; max-width: 64vw; }

      /* On mobile: hide table, show profile cards */
      .table-wrap{ display:none; }
      .profile-grid{ display:grid; }
    }

    @media (prefers-reduced-motion: reduce){
      *{ transition:none !important; animation:none !important; }
    }
  </style>
</head>

<body>
  <div class="background"></div>

  <!-- زر القائمة -->
  <button class="menu-btn" id="menuBtn" type="button" aria-label="فتح القائمة" onclick="toggleSidebar()">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
  </button>

  <!-- الهيدر -->
  <header>
    <div class="container header-inner">
      <div style="width:46px; height:46px; flex-shrink:0;"></div>

      <h1 class="header-title">
        ملفي
        <span class="badge">المعلم</span>
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

  <!-- القائمة الجانبية -->
  <aside class="sidebar" id="sidebar" aria-label="القائمة الجانبية">
    <div class="sidebar-header">
      <div class="sidebar-title">القائمة</div>
      <button class="close-sidebar" type="button" aria-label="إغلاق" onclick="closeSidebar()">×</button>
    </div>

    <a href="{{ route('plans.index') }}">الخطط</a>
    <a href="{{ route('tasks.index') }}">الواجبات</a>
    <a href="{{ route('teachers.index') }}">المعلمين</a>
    <a href="{{ route('students.index') }}">الطلاب</a>
    <a href="{{ route('absences.index') }}">الغيابات</a>
    <a href="{{ route('calendars.index') }}">التقويم</a>
    <a href="{{ route('files.index') }}">الملفات</a>
    <a href="{{ route('control_page') }}">الرئيسية</a>
  </aside>

  <main class="container">
    <section class="hero">
      <div class="hero-title">معلوماتي</div>
    </section>

    <div class="card">
      <!-- Desktop / Tablet Table -->
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>الاسم</th>
              <th>الهاتف</th>
              <th>الوظيفة</th>
              <th>المؤهل</th>
              <th>الراتب</th>
              <th>البريد الإلكتروني</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ optional($user)->name ?? '-' }}</td>
              <td>{{ optional($teacher)->phone ?? '-' }}</td>
              <td>{{ optional($teacher)->position ?? '-' }}</td>
              <td>{{ optional($teacher)->qualification ?? '-' }}</td>
              <td>{{ optional($teacher)->salary ?? '-' }}</td>
              <td>{{ optional($user)->email ?? '-' }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Mobile Cards -->
      <div class="profile-grid">
        <div class="info">
          <div>
            <b>الاسم</b>
            <span>{{ optional($user)->name ?? '-' }}</span>
          </div>
        </div>

        <div class="info">
          <div>
            <b>الهاتف</b>
            <span id="phoneText">{{ optional($teacher)->phone ?? '-' }}</span>
          </div>
          <button class="copy-btn" type="button" aria-label="نسخ الهاتف" onclick="copyText('phoneText')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h10a2 2 0 012 2v10a2 2 0 01-2 2H8a2 2 0 01-2-2V9a2 2 0 012-2z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 17H5a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v1"/>
            </svg>
          </button>
        </div>

        <div class="info">
          <div>
            <b>الوظيفة</b>
            <span>{{ optional($teacher)->position ?? '-' }}</span>
          </div>
        </div>

        <div class="info">
          <div>
            <b>المؤهل</b>
            <span>{{ optional($teacher)->qualification ?? '-' }}</span>
          </div>
        </div>

        <div class="info">
          <div>
            <b>الراتب</b>
            <span>{{ optional($teacher)->salary ?? '-' }}</span>
          </div>
        </div>

        <div class="info">
          <div>
            <b>البريد الإلكتروني</b>
            <span id="emailText">{{ optional($user)->email ?? '-' }}</span>
          </div>
          <button class="copy-btn" type="button" aria-label="نسخ البريد" onclick="copyText('emailText')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h10a2 2 0 012 2v10a2 2 0 01-2 2H8a2 2 0 01-2-2V9a2 2 0 012-2z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 17H5a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v1"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </main>

  <div class="mini-toast" id="miniToast">تم النسخ ✅</div>

  <script>
    function lockScroll(lock){
      document.body.style.overflow = lock ? 'hidden' : '';
    }

    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      const overlay = document.getElementById("overlay");
      const isOpen = sidebar.classList.toggle("open");
      overlay.classList.toggle("open", isOpen);
      lockScroll(isOpen);
    }
    function closeSidebar(){
      document.getElementById("sidebar").classList.remove("open");
      document.getElementById("overlay").classList.remove("open");
      lockScroll(false);
    }

    document.addEventListener('keydown', (e) => {
      if(e.key === 'Escape'){
        closeSidebar();
        lockScroll(false);
      }
    });

    async function copyText(id){
      const el = document.getElementById(id);
      if(!el) return;
      const text = (el.textContent || '').trim();
      if(!text || text === '-') return;

      try{
        await navigator.clipboard.writeText(text);
      }catch(e){
        const ta = document.createElement('textarea');
        ta.value = text;
        document.body.appendChild(ta);
        ta.select();
        document.execCommand('copy');
        ta.remove();
      }

      const t = document.getElementById('miniToast');
      t.classList.add('show');
      clearTimeout(window.__toastTimer);
      window.__toastTimer = setTimeout(() => t.classList.remove('show'), 1400);
    }
  </script>
</body>
</html>