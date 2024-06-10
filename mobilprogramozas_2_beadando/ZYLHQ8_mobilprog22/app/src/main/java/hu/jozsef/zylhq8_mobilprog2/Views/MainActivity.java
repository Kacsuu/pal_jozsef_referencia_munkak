package hu.jozsef.zylhq8_mobilprog2.Views;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

import hu.jozsef.zylhq8_mobilprog2.Controllers.MainController;
import hu.jozsef.zylhq8_mobilprog2.R;

public class MainActivity extends AppCompatActivity {
    private Button buttonSensors;
    private Button buttonRoom;
    private Button buttonToWorkManager;
    private Button buttonService;
    private Button buttonHilt;
    private MainController controller;
    @SuppressLint("MissingInflatedId")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        buttonSensors = findViewById(R.id.buttonSensors);
        buttonRoom = findViewById(R.id.buttonRoom);
        buttonToWorkManager = findViewById(R.id.buttonToWorkManager);
        buttonService = findViewById(R.id.buttonService);
        buttonHilt = findViewById(R.id.buttonHilt);
        controller = new MainController(this);

        buttonSensors.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                controller.handleSensorsNavigation(MainActivity.this);
            }
        });

        buttonRoom.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) { controller.handleRoomNavigation(MainActivity.this); }
        });

        buttonToWorkManager.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) { controller.handleWorkManagerNavigation(MainActivity.this); }
        });

        buttonService.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) { controller.handleServiceNavigation(MainActivity.this); }
        });

        buttonHilt.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) { controller.handleHiltNavigation(MainActivity.this); }
        });
    }
}