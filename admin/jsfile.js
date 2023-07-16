 const select = document.querySelector('select');
  const para6 = document.querySelector('#showSS3');
  const para5 = document.querySelector('#showSS2');
  const para4 = document.querySelector('#showSS1');
  const para3 = document.querySelector('#showJS3');
  const para2 = document.querySelector('#showJS2A');
  const para7 = document.querySelector('#showJS2b');
  const para1 = document.querySelector('#showJS1');
  const para = document.querySelector('#msg');
  const para8 = document.querySelector('#showClass6');
 
  select.addEventListener('change', setWeather);

  function setWeather() {
    const choice = select.value;

    if (choice === 'ss1') {
      para4.style.display = 'block';
      para.style.display = 'none';
      para1.style.display = 'none';
      para2.style.display = 'none';
      para3.style.display = 'none';
      para8.style.display = 'none';
      para5.style.display = 'none';
      para6.style.display = 'none';
      para7.style.display = 'none';
    } else if (choice === 'ss2') {
      
      para5.style.display = 'block';
      para.style.display = 'none';
      para1.style.display = 'none';
      para2.style.display = 'none';
      para3.style.display = 'none';
      para4.style.display = 'none';
      para8.style.display = 'none';
      para6.style.display = 'none';
      para7.style.display = 'none';

    } else if (choice === 'ss3') {
      
      para6.style.display = 'block';
      para.style.display = 'none';
      para1.style.display = 'none';
      para2.style.display = 'none';
      para3.style.display = 'none';
      para4.style.display = 'none';
      para5.style.display = 'none';
      para8.style.display = 'none';
      para7.style.display = 'none';
      
    } else if (choice === 'js1') {
      
      para1.style.display = 'block';
      para.style.display = 'none';
      para8.style.display = 'none';
      para2.style.display = 'none';
      para3.style.display = 'none';
      para4.style.display = 'none';
      para5.style.display = 'none';
      para6.style.display = 'none';
      para7.style.display = 'none';

    } else if (choice === 'js2A') {
      
      para2.style.display = 'block';
      para.style.display = 'none';
      para1.style.display = 'none';
      para8.style.display = 'none';
      para3.style.display = 'none';
      para4.style.display = 'none';
      para5.style.display = 'none';
      para6.style.display = 'none';
      para7.style.display = 'none';
      
    }else if (choice === 'js2b') {
      
      para7.style.display = 'block';
      para.style.display = 'none';
      para1.style.display = 'none';
      para2.style.display = 'none';
      para3.style.display = 'none';
      para4.style.display = 'none';
      para5.style.display = 'none';
      para6.style.display = 'none';
      para8.style.display = 'none';

    }else if (choice === 'js3') {
      
      para3.style.display = 'block';
      para.style.display = 'none';
      para1.style.display = 'none';
      para2.style.display = 'none';
      para8.style.display = 'none';
      para4.style.display = 'none';
      para5.style.display = 'none';
      para6.style.display = 'none';
      para7.style.display = 'none';

    }else if (choice === 'class6') {
      
      para8.style.display = 'block';
      para.style.display = 'none';
      para1.style.display = 'none';
      para2.style.display = 'none';
      para3.style.display = 'none';
      para4.style.display = 'none';
      para5.style.display = 'none';
      para6.style.display = 'none';
      para7.style.display = 'none';



    }else{   
      para.style.display = 'block';

    }

  }