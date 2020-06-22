package com.example.clevertapsdk;

import androidx.appcompat.app.AppCompatActivity;

import android.app.NotificationManager;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;

import com.clevertap.android.sdk.CleverTapAPI;

import java.util.HashMap;

public class MainActivity extends AppCompatActivity {
    Button productData;
    private static final String TAG = "Logging";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        CleverTapAPI clevertapDefaultInstance;
        clevertapDefaultInstance = CleverTapAPI.getDefaultInstance(getApplicationContext());

        productData = (Button) findViewById(R.id.product);
        productData.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                CleverTapAPI clevertap = CleverTapAPI.getDefaultInstance(getApplicationContext());// Do something in response to button click
                CleverTapAPI.createNotificationChannel(getApplicationContext(),"1","App launch jashank","Your Channel Description", NotificationManager.IMPORTANCE_MAX,true);

               //Event
                clevertap.pushEvent("Product Viewed");
               HashMap<String, Object> prodViewedAction = new HashMap<String, Object>();
                prodViewedAction.put("Product ID", "1");
                prodViewedAction.put("Product Name", "CleverTap");
                prodViewedAction.put("Product Image", "https://d35fo82fjcw0y8.cloudfront.net/2018/07/26020307/customer-success-clevertap.jpg");
                clevertap.pushEvent("Product viewed", prodViewedAction);

                //Email
                HashMap<String, Object> profileUpdate = new HashMap<String, Object>();
                profileUpdate.put("Email", "dk+jashank95@clevertap.com");
                clevertap.pushProfile(profileUpdate);
                Log.d(TAG, String.valueOf(profileUpdate));

            }
        });

    }
}