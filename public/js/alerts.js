const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
function closeAlert(){
  Swal.close()
}
  
function activeLoader(title,html){
  Swal.fire({
    title: title,
    html: html,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
        }, 100)
    },
    willClose: () => {
        clearInterval(timerInterval)
    }
  })
}

function notification(icon, message)
{
    Toast.fire({
        icon: icon,
        title: message
    })
}

function errorAlert(title, html){
  Swal.fire({
      icon: 'error',
      title: title,
      text: html
  })
}

function warningAlert(title, html){
  Swal.fire({
      icon: 'warning',
      title: title,
      text: html
  })
}

function successAlert(title, html){
  Swal.fire({
      icon: 'success',
      title: title,
      text: html
  })
}