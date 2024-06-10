package hu.jozsef.zylhq8_mobilprog2.Controllers;

import android.content.Intent;

import hu.jozsef.zylhq8_mobilprog2.Views.HiltActivity;
import hu.jozsef.zylhq8_mobilprog2.Views.MainActivity;
import hu.jozsef.zylhq8_mobilprog2.Views.RoomActivity;
import hu.jozsef.zylhq8_mobilprog2.Views.SensorsActivity;
import hu.jozsef.zylhq8_mobilprog2.Views.ServiceActivity;
import hu.jozsef.zylhq8_mobilprog2.Views.WorkManagerActivity;

public class MainController {
    private MainActivity view;

    public MainController(MainActivity view) {
        this.view = view;
    }
    public void handleSensorsNavigation(MainActivity activity) {
        Intent intent = new Intent(activity, SensorsActivity.class);
        activity.startActivity(intent);
    }

    public void handleRoomNavigation(MainActivity activity) {
        Intent intent = new Intent(activity, RoomActivity.class);
        activity.startActivity(intent);
    }

    public void handleWorkManagerNavigation(MainActivity activity) {
        Intent intent = new Intent(activity, WorkManagerActivity.class);
        activity.startActivity(intent);
    }

    public void handleServiceNavigation(MainActivity activity) {
        Intent intent = new Intent(activity, ServiceActivity.class);
        activity.startActivity(intent);
    }

    public void handleHiltNavigation(MainActivity activity) {
        Intent intent = new Intent(activity, HiltActivity.class);
        activity.startActivity(intent);
    }
}
