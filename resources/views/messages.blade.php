<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title> المحادثة الجماعية  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    .actions button {
      border: none;
      cursor: pointer;
      font-size: 13px;
      font-weight: 600;
      padding: 4px 8px;
      border-radius: 6px;
      margin-top: 4px;
      background: #2563eb;    /* أزرق */
      color: #fff;            /* نص أبيض */
      transition: all 0.2s ease;
    }
    .actions button:hover {
      background: #1e40af;    /* أزرق أغمق */
      color: #fff;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: "Cairo", sans-serif; background: #f5f7fa; color: #333; }

    .background {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      background: url('/fun.jpg') no-repeat center center;
      background-size: cover; filter: blur(10px) brightness(0.7); z-index: -1;
    }

    header {
      background: linear-gradient(90deg, #273955ff, #304056ff);
      color: #fff; display: flex; justify-content: space-between; align-items: center;
      padding: 20px 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.15);
      position: sticky; top: 0; z-index: 900; min-height: 70px;
    }
    header h1 { font-size: 22px; font-weight: 700; margin: 0 auto; }

    /* زر القائمة */
    .menu-btn {
      flex-shrink: 0;
      position: fixed;
      top: 20px;
      right: 20px;
      background: #253b5cff;
      color: #fff;
      border: none;
      border-radius: 12px;
      padding: 10px 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.25);
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
      z-index: 1100;
    }
    .menu-btn svg { width: 26px; height: 26px; }
    .menu-btn:hover { background: #2563eb; transform: translateY(-1px); }

    /* القائمة الجانبية */
    .sidebar {
      position: fixed;
      top: 0;
      right: -280px;
      width: 280px;
      height: 100%;
      background: #273955ff;
      color: #fff;
      padding: 25px 20px;
      box-shadow: -4px 0 20px rgba(0,0,0,0.3);
      transition: right 0.4s ease;
      z-index: 1000;
      border-radius: 8px 0 0 8px;
      overflow-y: auto;
    }
    .sidebar.open { right: 0; }
    .sidebar h2 {
      margin-bottom: 25px;
      font-size: 18px;
      font-weight: 700;
      border-bottom: 1px solid rgba(255,255,255,0.2);
      padding-bottom: 10px;
      text-align: center;
    }
    .sidebar a {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #fff;
      text-decoration: none;
      margin-bottom: 16px;
      font-size: 16px;
      font-weight: 600;
      padding: 14px 18px;
      border-radius: 12px;
      background: #2d3748;
      box-shadow: 0 4px 12px rgba(0,0,0,0.25);
      transition: all 0.3s ease;
    }
    .sidebar a:hover {
      background: #253b5cff;
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(0,0,0,0.35);
    }
    .close-btn {
      position: absolute;
      top: 20px;
      left: 20px;
      background: transparent;
      border: none;
      color: #fff;
      font-size: 26px;
      cursor: pointer;
    }

    .container { max-width: 800px; margin: 90px auto 40px auto; display: flex; flex-direction: column; gap: 15px; }
    .chat-container {
      display: flex; flex-direction: column; gap: 12px; height: 600px;
      overflow-y: auto; padding: 15px; background: rgba(255,255,255,0.15);
      backdrop-filter: blur(10px); border-radius: 20px;
      border: 1px solid rgba(255,255,255,0.2);
    }

    .date-separator {
      text-align: center; margin: 10px 0; font-size: 13px;
      color: #666; font-weight: 600;
    }

    .chat-message {
      max-width: 70%; padding: 12px 16px 26px 16px;
      border-radius: 16px; background: rgba(255,255,255,0.25);
      backdrop-filter: blur(10px); position: relative;
      word-wrap: break-word; transition: all 0.3s ease;
    }
    .chat-message.user {
      margin-left: auto; background: #2563eb; color: #fff;
    }
    .chat-message.admin {
      margin-right: auto; background: #ffeeba; color: #333;
    }
    .chat-message.other {
      margin-right: auto; background: #f0f0f0; color: #333;
    }

    .message-sender {
      font-size: 12px;
      font-weight: 600;
      margin-bottom: 4px;
      color: #fff;   /* اسم المرسل أبيض */
    }

    .message-time {
      font-size: 11px;
      color: #fff;   /* أبيض بالكامل */
      position: absolute; bottom: 6px; left: 12px;
    }

    .message-actions {
      display: none; justify-content: flex-end; gap: 10px;
      margin-top: 6px; font-size: 13px;
    }
    .chat-message:hover .message-actions { display: flex; }
    .message-actions span {
      cursor: pointer; color: #fff; font-weight: 600; /* أبيض */
    }

    .edit-form textarea {
      width: 100%; padding: 8px; border-radius: 10px;
      border: 1px solid #ccc; font-family: "Cairo", sans-serif;
      resize: none;
    }
    .edit-form .buttons {
      display: flex; justify-content: flex-end; gap: 8px; margin-top: 6px;
    }
    .edit-form button {
      padding: 6px 12px; border-radius: 6px; border: none; cursor: pointer;
    }
    .edit-form .save-btn { background: #2563eb; color: #fff; }
    .edit-form .cancel-btn { background: #ccc; }

    .send-form { display: flex; align-items: center; gap: 6px; margin-top: 10px; }
    .send-form input {
      flex: 1; padding: 10px 14px; border-radius: 20px; border: 1px solid #ccc;
      font-family: "Cairo", sans-serif;
    }
    .send-form button {
      background: #2563eb; border: none; padding: 10px 12px; border-radius: 50%;
      cursor: pointer; display: flex; align-items: center; justify-content: center; color: #fff;
    }
    .send-form button:hover { background: #1e40af; }
  </style>
</head>

  <div class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <h2>القائمة</h2>
      <button class="close-btn" onclick="toggleSidebar()">×</button>
    </div>
    <a href="{{ route('home') }}">الرئيسية</a>
    <a href="{{ route('my.absences') }}">غياباتي</a>
    <a href="{{ route('my.profile') }}">ملفي الشخصي</a>
    <a href="{{ route('my.calendar') }}">التقويم</a>
    <a href="{{ route('my.plan') }}">خطتي</a>
    <a href="{{ route('s_index') }}">مهامي</a>
  </div>
<body>
<div class="background"></div>

  <!-- زر القائمة -->
  <button class="menu-btn" id="menuBtn" onclick="toggleSidebar()">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
  </button>

<header>
  <h1>المحادثة الجماعية   </h1>
</header>

<div class="container">
  <div class="chat-container" id="chatContainer">
   @foreach($messages->reverse() as $message) <!-- نعكس الترتيب ليبدأ من الأقدم -->
  <div class="chat-message {{ $message->user_id == auth()->id() ? 'user' : 'other' }}" data-id="{{ $message->id }}">
    <div class="message-sender">
        {{ $message->user ? $message->user->name : 'مستخدم مجهول' }}
    </div>
    <div class="message-body">{{ $message->message }}</div>
    <div class="message-time">{{ $message->created_at->format('H:i') }}</div>
    <div class="message-actions">
      <span class="edit">تعديل</span>
      <span class="delete">حذف</span>
    </div>
  </div>
@endforeach

  </div>

  <form class="send-form" id="sendMessageForm">
    @csrf
    <input type="text" name="message" placeholder="اكتب رسالتك..." required />
    <button type="submit">➤</button>
  </form>
</div>

<script>
const chatContainer = document.getElementById('chatContainer');
const form = document.getElementById('sendMessageForm');

function fetchMessages() {
  fetch("{{ route('message.fetch') }}")
  .then(res => res.text())
  .then(html => {
    chatContainer.innerHTML = html;
    chatContainer.scrollTop = chatContainer.scrollHeight;

    // التعديل
    document.querySelectorAll('.edit').forEach(btn => {
      btn.onclick = function() {
        const msgDiv = btn.closest('.chat-message');
        const body = msgDiv.querySelector('.message-body');
        const oldText = body.innerText;

        msgDiv.innerHTML = `
          <form class="edit-form">
            <textarea rows="2">${oldText}</textarea>
            <div class="buttons">
              <button type="button" class="cancel-btn">إلغاء</button>
              <button type="submit" class="save-btn">حفظ</button>
            </div>
          </form>`;

        const formEdit = msgDiv.querySelector('.edit-form');
        formEdit.onsubmit = function(e){
          e.preventDefault();
          const updatedMessage = formEdit.querySelector('textarea').value;
          fetch("/messages/" + msgDiv.dataset.id, {
            method: 'PUT',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Content-Type':'application/json'
            },
            body: JSON.stringify({ message: updatedMessage })
          }).then(() => fetchMessages());
        };
        formEdit.querySelector('.cancel-btn').onclick = () => fetchMessages();
      }
    });

    // الحذف
    document.querySelectorAll('.delete').forEach(btn => {
      btn.onclick = function() {
        const msgDiv = btn.closest('.chat-message');
        if(confirm('هل أنت متأكد من حذف هذه الرسالة؟')) {
          fetch("/messages/" + msgDiv.dataset.id, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
          }).then(() => fetchMessages());
        }
      }
    });
  });
}

form.addEventListener('submit', function(e){
  e.preventDefault();
  const formData = new FormData(form);
  fetch("{{ route('message.store') }}", {
    method: 'POST',
    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
    body: formData
  }).then(() => {
    form.reset();
    fetchMessages();
  });
});

setInterval(fetchMessages, 4000);
fetchMessages();
 function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const menuBtn = document.getElementById("menuBtn");
    sidebar.classList.toggle("open");
    menuBtn.style.display = sidebar.classList.contains("open") ? "none" : "block";
}
</script>
</body>
</html>
