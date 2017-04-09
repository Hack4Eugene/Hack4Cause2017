package com.traffick.stop.webviewapp;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.webkit.WebView;
import android.webkit.WebViewClient;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        String url = "https://traffickstop.info/reporter/";
        String reporterName = "test";
        // String reporterPass = "test";
        WebView view = (WebView) this.findViewById(R.id.webView);
        view.setWebViewClient(new WebViewClient());
        view.getSettings().setJavaScriptEnabled(true);
        view.getSettings().setDomStorageEnabled(true);
        view.loadUrl(url);
        view.loadUrl("javascript:(function() { document.getElementById('inputUsername').value='"+
                reporterName +"'; })()");
    }
}
// inputUsername
// inputPassword
// submit