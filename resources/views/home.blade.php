<script>
    var finished_rendering = function() {
        console.log("finished rendering plugins");
        var spinner = document.getElementById("spinner");
        spinner.removeAttribute("style");
        spinner.removeChild(spinner.childNodes[0]);
    }
    FB.Event.subscribe('xfbml.render', finished_rendering);
</script>
<div id="spinner" style="
        background: #4267b2;
        border-radius: 5px;
        color: white;
        height: 40px;
        text-align: center;
        width: 250px;">
    Loading
    <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-use-continue-as="true"></div>
</div>