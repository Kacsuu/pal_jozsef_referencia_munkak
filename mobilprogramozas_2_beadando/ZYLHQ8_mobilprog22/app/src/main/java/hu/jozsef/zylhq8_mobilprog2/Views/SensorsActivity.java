package hu.jozsef.zylhq8_mobilprog2.Views;

import android.hardware.Sensor;
import android.hardware.SensorEvent;
import android.hardware.SensorEventListener;
import android.hardware.SensorManager;
import android.os.Bundle;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import java.util.List;

import hu.jozsef.zylhq8_mobilprog2.R;

public class SensorsActivity extends AppCompatActivity {
    private SensorManager sensorManager;
    private TextView textViewSensor;
    private TextView textViewSensorData;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sensors);

        textViewSensor = findViewById(R.id.textViewSensor);
        textViewSensorData = findViewById(R.id.textViewSensorData);

        sensorManager = (SensorManager) getSystemService(SENSOR_SERVICE);
        List<Sensor> sensors=sensorManager.getSensorList(Sensor.TYPE_ALL);

        StringBuilder sensorInfo = new StringBuilder();
        for (Sensor sensor : sensors) {
            sensorInfo.append("Name: ").append(sensor.getName()).append("\n")
                    .append("Version: ").append(sensor.getVersion()).append("\n")
                    .append("Vendor: ").append(sensor.getVendor()).append("\n")
                    .append("Type: ").append(sensor.getType()).append("\n\n");
        }
        textViewSensor.setText(sensorInfo.toString());

        Sensor accelerometer = sensorManager.getDefaultSensor(Sensor.TYPE_ACCELEROMETER);
        if (accelerometer != null) {
            sensorManager.registerListener(sensorEventListener, accelerometer, SensorManager.SENSOR_DELAY_NORMAL);
        }
    }

    private final SensorEventListener sensorEventListener = new SensorEventListener() {
        @Override
        public void onSensorChanged(SensorEvent event) {
            float x = event.values[0];
            float y = event.values[1];
            float z = event.values[2];
            String sensorData = "\nAccelerometer Data:\nX: " + x + "\nY: " + y + "\nZ: " + z;
            textViewSensorData.setText(sensorData);
        }

        @Override
        public void onAccuracyChanged(Sensor sensor, int accuracy) {
        }
    };
}
