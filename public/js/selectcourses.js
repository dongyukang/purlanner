$('.selectpicker_subject').selectpicker();
$('.selectpicker_number').selectpicker();
$('.selectpicker_section').selectpicker();


function chooseCourseNumber()
{
  var subject = $('.selectpicker_subject').val();
  $('.selectpicker_number').selectpicker('val', 'default');
  $('.selectpicker_section').selectpicker('val', 'default');
}

// $('#submitcourse').click(function (e) {
//   e.preventDefault();
// });

function test()
{
}
