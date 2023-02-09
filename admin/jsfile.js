 const select = document.querySelector('select');
  const para6 = document.querySelector('#showSS3');
  const para5 = document.querySelector('#showSS2');
  const para4 = document.querySelector('#showSS1');
  const para3 = document.querySelector('#showJS3');
  const para2 = document.querySelector('#showJS2');
  const para1 = document.querySelector('#showJS1');
  const para = document.querySelector('#msg');
 
  select.addEventListener('change', setWeather);

  function setWeather() {
    const choice = select.value;

    if (choice === 'ss1') {

      para4.style.display = 'block';
      para6.style.display = 'none';
      para5.style.display = 'none';
      para3.style.display = 'none';
      para2.style.display = 'none';
      para1.style.display = 'none';
      para.style.display = 'none';


    } else if (choice === 'ss2') {
      
      para5.style.display = 'block';
      para6.style.display = 'none';
      para4.style.display = 'none';
      para3.style.display = 'none';
      para2.style.display = 'none';
      para1.style.display = 'none';
      para.style.display = 'none';



    } else if (choice === 'ss3') {
      
      para6.style.display = 'block';
      para4.style.display = 'none';
      para5.style.display = 'none';
      para3.style.display = 'none';
      para2.style.display = 'none';
      para1.style.display = 'none';
      para.style.display = 'none';


    } else if (choice === 'js1') {
      
      para1.style.display = 'block';
      para6.style.display = 'none';
      para5.style.display = 'none';
      para3.style.display = 'none';
      para2.style.display = 'none';
      para4.style.display = 'none';
      para.style.display = 'none';


    } else if (choice === 'js2') {
      
      para2.style.display = 'block';
      para6.style.display = 'none';
      para5.style.display = 'none';
      para3.style.display = 'none';
      para4.style.display = 'none';
      para1.style.display = 'none';
      para.style.display = 'none';


    } else if (choice === 'js3') {
      
      para3.style.display = 'block';
      para6.style.display = 'none';
      para5.style.display = 'none';
      para4.style.display = 'none';
      para2.style.display = 'none';
      para1.style.display = 'none';
      para.style.display = 'none';

    }

  }