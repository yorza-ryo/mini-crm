// loading show
$(document).ready(function () {
  if (sessionStorage.getItem('toastrSuccess')) {
    toastr.success(sessionStorage.getItem('toastrSuccess'));
    sessionStorage.removeItem('toastrSuccess');
  }
  if (sessionStorage.getItem('toastrInfo')) {
    toastr.info(sessionStorage.getItem('toastrInfo'));
    sessionStorage.removeItem('toastrInfo');
  }
  if (sessionStorage.getItem('toastrWarning')) {
    toastr.warning(sessionStorage.getItem('toastrWarning'));
    sessionStorage.removeItem('toastrWarning');
  }
  if (sessionStorage.getItem('toastrError')) {
    toastr.error(sessionStorage.getItem('toastrError'));
    sessionStorage.removeItem('toastrError');
  }

  if (sessionStorage.getItem('toastrProgressSuccess')) {
    toastr.options.progressBar = true;
    toastr.success(sessionStorage.getItem('toastrProgressSuccess'));
    sessionStorage.removeItem('toastrProgressSuccess');
  }
  if (sessionStorage.getItem('toastrProgressInfo')) {
    toastr.options.progressBar = true;
    toastr.info(sessionStorage.getItem('toastrProgressInfo'));
    sessionStorage.removeItem('toastrProgressInfo');
  }
  if (sessionStorage.getItem('toastrProgressWarning')) {
    toastr.options.progressBar = true;
    toastr.warning(sessionStorage.getItem('toastrProgressWarning'));
    sessionStorage.removeItem('toastrProgressWarning');
  }
  if (sessionStorage.getItem('toastrProgressError')) {
    toastr.options.progressBar = true;
    toastr.error(sessionStorage.getItem('toastrProgressError'));
    sessionStorage.removeItem('toastrProgressError');
  }

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
});
