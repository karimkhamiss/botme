/**
 * function to get errors and handle them.
 * array of selectors
 * @param error
 * @param selectors
 * @param fields
 */
function error_handler(error,selectors,fields) {
    var error_text = "";
    for (var i = 0; i < fields.length;i++)
    {
        error_text = error[fields[i]];
        if(error.hasOwnProperty(fields[i]))
        {
            $(selectors[i]).html(error_text);
            $(selectors[i]).addClass("alert alert-danger");
            $(selectors[i]).fadeIn();


        }else {
            $(selectors[i]).removeClass("alert alert-danger");
            $(selectors[i]).fadeOut();
        }
    }
}

/**
 * function to empty out the error labels
 * @param selectors
 */
function empty_errors(selectors) {
    for(var i = 0; i < selectors.length ; i++)
    {
        $(selectors[i]).html('');
    }
}

/**
 * function to take selector and print out the text on it
 * @param selector
 * @param text
 * @param type
 */
function PrintOnSelector(selector,text,type) {
    $(selector).html(text);
}
function button_waiting(selector)
{
  //   var text = selector.html();
  // selector.html(text + " <i class='fa fa-gear'></i>");
  selector.css({
    opacity:.5
  });
  selector.prop('disabled', true)
}
function waiting()
{
    $(".background2").fadeIn();
    $("#loading").fadeIn();
}
function finish()
{
    $(".background2").fadeOut();
    $("#loading").fadeOut();
}
function reload(data)
{
    var first_letter = data['responseText'].substr(0,1);
    if(first_letter == "<")
    {
        finish();
        waiting();
        $("#loading").append("<b class='text-center ' style='padding:5px 20px;font-size:18px;display: block !important; width:100% !important;'>Sorry , The page will reload now <br> Try Again Later</b>");
        $("#loading").delay(2500).fadeOut(function () {
            location.reload();
        });
    }
    else
        finish();
}
function tellme(data)
{
    w = window.open('','newwinow','width=800,height=600,menubar=1,status=0,scrollbars=1,resizable=1');
    d = w.document.open("text/html","replace");
    d.writeln(data['responseText']);
}
function button_done(selector)
{
    // selector.children('i').fadeOut();
  selector.css({
    opacity:1
  });
  selector.prop('disabled', false)
}
function back()
{
    location.href = document.referrer;
}
