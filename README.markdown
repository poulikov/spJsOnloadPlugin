#README

Example:

    <?php use_helper("JsOnload"); ?>

    <?php start_js_onload(); ?>
    alert("first");
    <?php end_js_onload(); ?>
    
    // ...

    <?php start_js_onload(); ?>
    alert("second");
    <?php end_js_onload(); ?>

in response, in html before &lt;/head&gt;

    window.onload = function() 
    {

    }
    //<![CDATA[
    window.onload = function()
    {

    //****************************************
    alert("first");

    //****************************************
    alert("second");

    };
    //]]>


in app.yml

    all:
      spJsonloadPlugin:
        use_jquery: false

