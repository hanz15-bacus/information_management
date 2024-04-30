

//FOR THE INDEX.PHP

// function openMenu() {
//   const el = document.querySelector('.menu');
//   if (el.classList.contains('close-menu')) {
//     el.classList.remove('close-menu');
//     el.classList.add('open-menu');
//   } else if (el.classList.contains('open-menu')) {
//     el.classList.add('close-menu');
//     el.classList.remove('open-menu');
//   } else {
//     el.classList.add('open-menu');
//   }
// }
function registerFormSubmit() {
  document.forms[0].action = "./includes/register.php";
  document.forms[0].submit();
}
(function () {
    // document.querySelector('.menu').style.bottom = '-10%';
    const el = document.querySelector('.menu');
    el.style.bottom = '-10%';
    el.style.opacity = '0';
  })();
  
  function toggleMenu() {
    const el = document.querySelector('.menu');
    if (el.style.bottom == '-10%') {
      el.style.bottom = '100px';
      el.style.opacity = '1';
      document.querySelector('.toggle__menu-open').style.opacity = '0';
      document.querySelector('.toggle__menu-close').style.opacity = '1';
    } else {
      el.style.bottom = '-10%';
      el.style.opacity = '0';
      document.querySelector('.toggle__menu-open').style.opacity = '1';
      document.querySelector('.toggle__menu-close').style.opacity = '0';
    }
  }
  
  function addActiveClass(context) {
    const navItems = document.querySelectorAll('.menu-icon');
    const navItem = document.getElementById(context);
    navItems.forEach((nav) => {
      nav.classList.remove('nav-active');
    });
    navItem.classList.add('nav-active');
  }
  
  const navItems = document.querySelectorAll('.menu-icon');
  
  const toolTips = document.querySelectorAll('.tooltip');
  
  function addToolTip(key) {
    removeTooltips();
    toolTips.forEach((tooltip) => {
      if (tooltip.getAttribute('data-key') == key) {
        tooltip.style.opacity = '1';
      }
    });
  }
  
  function removeTooltips() {
    toolTips.forEach((tooltip) => {
      tooltip.style.opacity = '0';
    });
  }
  
  navItems.forEach((item) => {
    item.addEventListener('mouseover', () => {
      addToolTip(item.getAttribute('id'));
    });
  });
  
  navItems.forEach((item) => {
    item.addEventListener('mouseleave', () => {
      removeTooltips();
    });
  });


