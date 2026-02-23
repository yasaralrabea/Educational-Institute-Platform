<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>إدارة الطلاب -  </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  --danger:#ef4444;
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
  white-space:nowrap;
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
.icon-btn:focus-visible{ box-shadow: 0 0 0 3px rgba(37,99,235,.45); }
.icon-btn svg{ width:22px; height:22px; }

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
.sidebar h2{ font-size:18px; font-weight:900; }
.sidebar .close-btn{
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
.sidebar .close-btn:hover{ background: rgba(255,255,255,.20); }

.sidebar a{
  display:flex;
  align-items:center;
  gap:12px;
  padding: 12px 12px;
  border-radius: 16px;
  background: rgba(255,255,255,.08);
  border: 1px solid rgba(255,255,255,.10);
  margin-bottom: 10px;
  transition:.22s;
}
.sidebar a:hover{
  background: rgba(255,236,29,.92);
  color:#111827;
  transform: translateX(-2px);
}
.sidebar a svg{ width:22px; height:22px; }

main{ padding: 22px 0 46px; }

.page-head{
  display:flex;
  align-items:flex-start;
  justify-content:space-between;
  gap:12px;
  margin: 18px 0 16px;
  flex-wrap: wrap;
}
h2{
  color: var(--primary);
  font-size: 20px;
  font-weight: 900;
}
.sub{
  color: var(--muted);
  font-size: 14px;
  margin-top: 6px;
}

.card{
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 16px;
}

.tools{
  display:flex;
  gap:12px;
  flex-wrap:wrap;
  align-items:end;
  justify-content:flex-end;
}

.search{
  min-width: 220px;
  flex: 1 1 260px;
  max-width: 420px;
  position: relative;
}
.control{
  width:100%;
  padding: 11px 12px;
  border-radius: 14px;
  border: 1px solid var(--border);
  font-size: 14px;
  background:#fff;
  outline:none;
  transition:.2s;
}
.control:focus{
  border-color: rgba(37,99,235,.55);
  box-shadow: 0 0 0 3px rgba(37,99,235,.18);
}
.search input{ padding-right: 40px; }
.search svg{
  position:absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  width: 18px; height: 18px;
  color: #64748b;
  pointer-events:none;
}

.btn{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:8px;
  padding: 10px 14px;
  border-radius: 14px;
  border: 1px solid transparent;
  cursor:pointer;
  font-weight: 900;
  font-size: 13px;
  transition:.2s;
  white-space:nowrap;
  user-select:none;
}
.btn-primary{
  background: var(--primary-2);
  color:#fff;
}
.btn-primary:hover{ filter: brightness(.96); transform: translateY(-1px); }
.btn-outline{
  background:#fff;
  border-color: var(--border);
  color: var(--text);
}
.btn-outline:hover{ background:#f9fafb; transform: translateY(-1px); }
.btn-danger{
  background: rgba(239,68,68,.12);
  border-color: rgba(239,68,68,.22);
  color:#991b1b;
}
.btn-danger:hover{ background: rgba(239,68,68,.16); transform: translateY(-1px); }

.table-wrap{ overflow:auto; }
table{
  width:100%;
  border-collapse: separate;
  border-spacing: 0 10px;
  min-width: 980px;
}
thead th{
  background: #f1f5f9;
  color: var(--primary);
  font-weight: 900;
  padding: 12px 14px;
  font-size: 14px;
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
  box-shadow: 0 2px 10px rgba(0,0,0,.04);
  font-size: 14px;
  vertical-align: middle;
  word-wrap: break-word;
}
tbody tr:hover td{ background:#fbfdff; }

.modal{
  display:none;
  position:fixed;
  inset:0;
  background: rgba(0,0,0,.55);
  z-index: 1300;
  padding: 18px;
  align-items:center;
  justify-content:center;
}
.modal.open{ display:flex; }
.modal-content{
  width: min(640px, 100%);
  max-height: 88vh;
  overflow:auto;
  background:#fff;
  border-radius: 22px;
  border: 1px solid var(--border);
  box-shadow: 0 24px 60px rgba(0,0,0,.30);
  padding: 18px;
  animation: pop .18s ease;
}
.modal-head{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:12px;
  padding-bottom: 10px;
  border-bottom: 1px solid #eef2f7;
  margin-bottom: 12px;
}
.modal-title{
  font-weight: 900;
  color: var(--primary);
  font-size: 18px;
}
.x-btn{
  width:42px;height:42px;border-radius:14px;
  border:1px solid var(--border);
  background:#f9fafb;
  cursor:pointer;
  font-size:20px;
  line-height:1;
  transition:.2s;
  display:flex;
  align-items:center;
  justify-content:center;
}
.x-btn:hover{ background:#eef2f7; }

.form-grid{
  display:grid;
  grid-template-columns: 1fr 1fr;
  gap:12px;
}
.form-group{
  display:flex;
  flex-direction:column;
  gap:6px;
}
.form-group label{
  font-weight:900;
  color:#334155;
  font-size: 13px;
}
.form-group small{
  color:#ef4444;
  font-size: 12px;
}

.stack{
  display:flex;
  flex-direction:column;
  gap:12px;
}

@keyframes pop{
  from{ opacity:0; transform: translateY(10px) scale(.985); }
  to{ opacity:1; transform: translateY(0) scale(1); }
}

@media (max-width: 920px){
  .form-grid{ grid-template-columns: 1fr; }
}

@media (max-width: 820px){
  .header-title{ font-size: 20px; }
  .menu-btn{ top: 14px; right: 14px; }
  .container{ width: calc(100% - 24px); }
  table{ min-width: 920px; }
}

@media (prefers-reduced-motion: reduce){
  *{ transition:none !important; animation:none !important; }
}
</style>
</head>
<body>
<div class="background"></div>

<button class="menu-btn" id="menuBtn" type="button" aria-label="فتح القائمة" onclick="toggleSidebar()">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
  </svg>
</button>

<header>
  <div class="container header-inner">
    <div style="width:46px; height:46px; flex-shrink:0;"></div>

    <h1 class="header-title">
      إدارة الطلاب
      <span class="badge">Students</span>
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

<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<div class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <h2>القائمة</h2>
    <button class="close-btn" type="button" onclick="closeSidebar()">×</button>
  </div>

  <a href="{{ route('plans.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M9 17v-6h13v6M9 5v6h13V5M3 7h2v10H3z"/>
    </svg> الخطط
  </a>

  <a href="{{ route('tasks.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M12 20h9M12 4h9M4 9h16M4 15h16"/>
    </svg> الواجبات
  </a>

  <a href="{{ route('teachers.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
    </svg> المعلمين
  </a>

  <a href="{{ route('students.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M5.121 17.804A13.937 13.937 0 0112 15a13.937 13.937 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
    </svg> الطلاب
  </a>

  <a href="{{ route('absences.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M9 17v-6h13v6M9 5v6h13V5M3 7h2v10H3z"/>
    </svg> الغيابات
  </a>

  <a href="{{ route('calendars.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
    </svg> التقويم
  </a>

  <a href="{{ route('files.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m0-4h4m-4 4h4"/>
    </svg> الملفات
  </a>

  <a href="{{ route('fins.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.333 0-4 1.333-4 4s2.667 4 4 4 4-1.333 4-4-2.667-4-4-4zM12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
    </svg> الإدارة المالية
  </a>

  <a href="{{ route('recitations.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M12 4h9M4 9h16M4 15h16"/>
    </svg> التسميع
  </a>

  <a href="{{ route('control_page') }}">الرئيسية</a>
</div>

<main class="container">
  <div class="page-head">
    <div>
      <h2>إدارة الطلاب</h2>
    </div>

    <div class="tools">
      <div class="search">
        <input id="searchInput" type="text" class="control" placeholder="ابحث باسم الطالب ..." oninput="applySearch()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3m1.8-5.2a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </div>
      <button class="btn btn-primary" type="button" onclick="openModal()">➕ إضافة طالب</button>
    </div>
  </div>

  <div class="card">
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>الاسم</th>
            <th>العمر</th>
            <th>المسار</th>
            <th>كمية الحفظ</th>
            <th>الإجراء</th>
          </tr>
        </thead>
        <tbody id="studentsTbody">
          @foreach($students as $student)
          <tr class="student-row" data-search="{{ mb_strtolower(($student->name ?? '').' '.($student->track ?? '').' '.($student->memorization ?? '').' '.($student->age ?? '')) }}">
            <td>{{ $student->name }}</td>
            <td>{{ $student->age }}</td>
            <td>{{ $student->track }}</td>
            <td>{{ $student->memorization }}</td>
            <td>
              <a href="{{ route('students.show', $student->id) }}" class="btn btn-outline">زيارة الملف الشخصي</a>
            </td>
          </tr>
          @endforeach

          <tr id="noResultsRow" style="display:none;">
            <td colspan="5" style="text-align:center; color:var(--muted); padding:16px;">
              لا توجد نتائج مطابقة للبحث
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="modal" id="studentModal" role="dialog" aria-modal="true">
    <div class="modal-content">
      <div class="modal-head">
        <div class="modal-title">إضافة طالب</div>
        <button class="x-btn" type="button" aria-label="إغلاق" onclick="closeModal()">×</button>
      </div>

      <form id="studentForm" action="{{ route('students.store') }}" method="POST" onsubmit="return validateForm(event)" class="stack">
        @csrf

        <div class="form-grid">
          <div class="form-group">
            <label>الاسم</label>
            <input class="control" type="text" name="name" required>
          </div>

          <div class="form-group">
            <label>البريد الإلكتروني</label>
            <input class="control" type="email" name="email" id="email" required>
            <small id="emailError" style="display:none;">البريد الإلكتروني مستخدم مسبقاً</small>
          </div>

          <div class="form-group">
            <label>كلمة المرور (8 أحرف على الأقل)</label>
            <input class="control" type="password" name="password" id="password" required>
          </div>

          <div class="form-group">
            <label>تأكيد كلمة المرور</label>
            <input class="control" type="password" name="password_confirmation" id="password_confirmation" required>
          </div>

          <div class="form-group">
            <label>العمر</label>
            <input class="control" type="number" name="age" required>
          </div>

          <div class="form-group">
            <label>كمية الحفظ</label>
            <input class="control" type="number" name="memorization" value="0" required>
          </div>

          <div class="form-group">
            <label>الأجزاء</label>
            <input class="control" type="text" name="juz" value="0" required>
          </div>

          <div class="form-group">
            <label>المستوى</label>
            <input class="control" type="text" name="level" required>
          </div>

          <div class="form-group">
            <label>المسار</label>
            <input class="control" type="text" name="track" required>
          </div>

          <div class="form-group">
            <label>الهدف</label>
            <input class="control" type="text" name="goal" required>
          </div>

          <div class="form-group">
            <label>رقم الهاتف</label>
            <input class="control" type="text" name="phone" required>
          </div>
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
          <button type="submit" class="btn btn-primary" style="flex:1;">إضافة</button>
          <button type="button" class="btn btn-outline" onclick="closeModal()">إلغاء</button>
        </div>
      </form>
    </div>
  </div>
</main>

<script>
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

function openModal(){ document.getElementById("studentModal").classList.add("open"); document.body.style.overflow='hidden'; }
function closeModal(){ document.getElementById("studentModal").classList.remove("open"); document.body.style.overflow=''; }

document.querySelectorAll('.modal').forEach(modal => {
  modal.addEventListener('click', (e) => {
    if(e.target === modal){
      modal.classList.remove('open');
      document.body.style.overflow = '';
    }
  });
});

document.addEventListener('keydown', (e) => {
  if(e.key === 'Escape'){
    closeModal();
    closeSidebar();
  }
});

function applySearch(){
  const q = (document.getElementById('searchInput')?.value || '').trim().toLowerCase();
  const rows = document.querySelectorAll('.student-row');
  const noResultsRow = document.getElementById('noResultsRow');
  let shown = 0;

  rows.forEach(r => {
    const hay = (r.getAttribute('data-search') || '');
    const ok = !q || hay.includes(q);
    r.style.display = ok ? '' : 'none';
    if(ok) shown++;
  });

  if(noResultsRow){
    noResultsRow.style.display = (q && shown === 0) ? '' : 'none';
  }
}

function validateForm(e) {
  e.preventDefault();
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const passwordConfirmation = document.getElementById('password_confirmation').value;
  const emailError = document.getElementById('emailError');

  if(password.length < 8){
    alert("كلمة المرور يجب أن تكون 8 أحرف على الأقل");
    return false;
  }

  if(password !== passwordConfirmation){
    alert("كلمة المرور وتأكيدها غير متطابقين");
    return false;
  }

  const existingEmails = ["test@example.com","student@example.com"];
  if(existingEmails.includes(email)){
    emailError.style.display = "block";
    return false;
  } else {
    emailError.style.display = "none";
  }

  e.target.submit();
}
</script>

</body>
</html>