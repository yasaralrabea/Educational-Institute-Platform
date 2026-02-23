{{-- resources/views/lightings_s.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>الإضاءات - للطلاب</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

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
    a{color:inherit;}
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
      text-decoration:none;
    }
    .icon-btn:hover{ background: rgba(255,255,255,.24); transform: translateY(-1px); }
    .icon-btn:focus-visible{ box-shadow: 0 0 0 3px rgba(37,99,235,.45); }
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
      text-decoration:none;
      color:#fff;
      background: rgba(255,255,255,.08);
      border: 1px solid rgba(255,255,255,.10);
      margin-bottom: 10px;
      transition:.22s;
      font-weight: 800;
    }
    .sidebar a:hover{
      background: rgba(255,236,29,.92);
      color:#111827;
      transform: translateX(-2px);
    }
    .sidebar a.active{
      background: rgba(255,255,255,.18);
      border-color: rgba(255,255,255,.24);
    }

    /* ===== Main ===== */
    main{ padding: 18px 0 70px; }

    .hero{
      margin-top: 18px;
      border-radius: var(--radius);
      padding: 18px;
      background: linear-gradient(135deg, rgba(37,99,235,.18), rgba(255,236,29,.14));
      border: 1px solid rgba(255,255,255,.30);
      box-shadow: 0 18px 40px rgba(0,0,0,.10);
      backdrop-filter: blur(10px);
    }
    .hero-title{
      color:#fff;
      font-weight: 900;
      font-size: 20px;
      letter-spacing:.2px;
    }
    .hero-sub{
      color: rgba(255,255,255,.88);
      font-size: 14px;
      margin-top: 6px;
      max-width: 70ch;
      font-weight: 700;
    }

    /* Grid Cards */
    .grid{
      margin-top: 14px;
      display:grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
    }

    .light-card{
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow:hidden;
      transition:.22s;
      display:flex;
      flex-direction:column;
      min-height: 100%;
    }
    .light-card:hover{ transform: translateY(-2px); box-shadow: 0 18px 44px rgba(15,23,42,.14); }

    .media{
      position:relative;
      width:100%;
      aspect-ratio: 16 / 9;
      background: linear-gradient(135deg, rgba(37,99,235,.14), rgba(255,236,29,.14));
      border-bottom: 1px solid rgba(0,0,0,.04);
      overflow:hidden;
    }
    .media img{
      width:100%;
      height:100%;
      object-fit:cover;
      display:block;
      transform: scale(1.01);
    }
    .no-img{
      position:absolute;
      inset:0;
      display:flex;
      align-items:center;
      justify-content:center;
      color: rgba(15,23,42,.55);
      font-weight: 900;
      font-size: 14px;
      padding: 10px;
      text-align:center;
    }

    .content{
      padding: 14px;
      display:flex;
      flex-direction:column;
      gap: 8px;
      flex: 1 1 auto;
    }
    .title{
      font-size: 16px;
      font-weight: 900;
      color: var(--primary);
      line-height: 1.4;
    }
    .desc{
      color: #334155;
      font-weight: 700;
      font-size: 14px;
      line-height: 1.7;
      word-break: break-word;
    }
    .meta{
      margin-top:auto;
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:10px;
      padding-top: 10px;
      border-top: 1px solid #eef2f7;
      color: var(--muted);
      font-weight: 800;
      font-size: 12px;
    }
    .pill{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      padding: 6px 10px;
      border-radius: 999px;
      font-weight: 900;
      font-size: 12px;
      border: 1px solid var(--border);
      background: #f8fafc;
      color: #334155;
    }

    .empty{
      background:#fff;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow-sm);
      padding: 18px;
      color: var(--muted);
      font-weight: 900;
      text-align:center;
    }

    /* Floating button (optional): scroll top */
    .fab{
      position: fixed;
      left: 18px;
      bottom: 18px;
      z-index: 1200;
      width: 52px;
      height: 52px;
      border-radius: 999px;
      background: var(--primary-2);
      color:#fff;
      border: none;
      box-shadow: 0 18px 36px rgba(0,0,0,.25);
      cursor:pointer;
      display:none;
      align-items:center;
      justify-content:center;
      transition: .2s;
    }
    .fab:hover{ transform: scale(1.05); filter: brightness(.96); }
    .fab svg{ width: 22px; height: 22px; }

    /* Responsive */
    @media (max-width: 1024px){
      .grid{ grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 820px){
      .header-title{ font-size: 20px; }
      .menu-btn{ top: 14px; right: 14px; }
    }
    @media (max-width: 640px){
      .container{ width: calc(100% - 24px); }
      .header-inner{ padding: 12px 0; }
      .header-title{ margin:0; max-width: 64vw; }
      .grid{ grid-template-columns: 1fr; }
      .fab{ display:flex; }
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
        الإضاءات
        <span class="badge">للطلاب</span>
      </h1>

      <div class="header-actions">
        <a class="icon-btn" href="{{ route('my.profile') }}" title="حسابي" aria-label="حسابي">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </a>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="icon-btn" type="submit" title="تسجيل خروج" aria-label="تسجيل خروج">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
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

    <a href="{{ route('home') }}">الرئيسية</a>
    <a href="{{ route('my.absences') }}">غياباتي</a>
    <a href="{{ route('my.profile') }}">ملفي الشخصي</a>
    <a href="{{ route('my.calendar') }}">التقويم</a>
    <a href="{{ route('my.plan') }}">خطتي</a>
    <a href="{{ route('s_index') }}">مهامي</a>
  </aside>

  <main class="container">
    <section class="hero">
      <div class="hero-title">إضاءات </div>
    </section>

    @if($lighting->count() === 0)
      <div class="empty" style="margin-top:14px;">لا توجد إضاءات حالياً.</div>
    @else
      <section class="grid" aria-label="بطاقات الإضاءات">
        @foreach($lighting as $light)
          <article class="light-card">
            <div class="media">
              @if(!empty($light->photo))
                <img src="{{ $light->photo }}" alt="صورة الإضاءة">
              @else
                <div class="no-img">لا توجد صورة</div>
              @endif
            </div>

            <div class="content">
              <div class="title">{{ $light->title }}</div>
              <div class="desc">{{ $light->lighting }}</div>

              <div class="meta">
                <span class="pill">إضاءة</span>
                {{-- إذا عندك تاريخ/منشئ لاحقاً ضعه هنا --}}
              </div>
            </div>
          </article>
        @endforeach
      </section>
    @endif
  </main>

  <!-- زر رجوع للأعلى (مفيد على الجوال) -->
  <button class="fab" type="button" onclick="window.scrollTo({top:0, behavior:'smooth'})" aria-label="للأعلى">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0l-7 7m7-7l7 7"/>
    </svg>
  </button>

  <script>
    // Sidebar
    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      const overlay = document.getElementById("overlay");
      const isOpen = sidebar.classList.toggle("open");
      overlay.classList.toggle("open", isOpen);
      document.body.style.overflow = isOpen ? 'hidden' : '';
    }
    function closeSidebar(){
      document.getElementById("sidebar").classList.remove("open");
      document.getElementById("overlay").classList.remove("open");
      document.body.style.overflow = '';
    }

    // ESC closes sidebar
    document.addEventListener('keydown', (e) => {
      if(e.key === 'Escape'){
        closeSidebar();
      }
    });
  </script>
</body>
</html>