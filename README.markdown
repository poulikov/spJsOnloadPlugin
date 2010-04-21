#README

Example:

    use_helper("JsOnload");

    start_js_onload();
    alert("first");
    end_js_onload();
    
    // ...

    start_js_onload();
    alert("second");
    end_js_onload();

in response

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

