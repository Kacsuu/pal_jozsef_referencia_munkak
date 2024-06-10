package hu.jozsef.zylhq8_mobilprog2.Views;

import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.view.View;

import androidx.appcompat.app.AppCompatActivity;

import hu.jozsef.zylhq8_mobilprog2.Controllers.MainController;
import hu.jozsef.zylhq8_mobilprog2.MyService;
import hu.jozsef.zylhq8_mobilprog2.R;

public class ServiceActivity extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_service);
        Intent intent = new Intent(this, MyService.class);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            startForegroundService( intent );
        } else {
            startService( intent );
        }
    }
}
