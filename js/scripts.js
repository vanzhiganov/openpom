$(document).ready(function(){
  $(".ack,.down,.option,.comment").colorbox({
    initialWidth: "340px",
    initialHeight: "340px"	
  });
  $('.chkbox').click(function(event) {
    if(!lastChecked) {
      lastChecked = this;
      return;
    }
    if(event.shiftKey) {
      var startchkbox = $('.chkbox').index(this);
      var endchkbox = $('.chkbox').index(lastChecked);
      for(i=Math.min(startchkbox,endchkbox);i<Math.max(startchkbox,endchkbox);i++) {
        $('.chkbox')[i].checked = lastChecked.checked;
      }
    }
    lastChecked = this;
  });
  
  var first_alert_item = $('table#alert tr.alert-item:first');
  if (first_alert_item.length) {
    popup.css('top', (first_alert_item.offset().top - 10) + 'px');
  }
  
  $('body').append(popup);
});

