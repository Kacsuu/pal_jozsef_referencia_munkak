package hu.jozsef.zylhq8_mobilprog2;

import android.annotation.SuppressLint;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.Service;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Build;
import android.os.Handler;
import android.os.HandlerThread;
import android.os.IBinder;
import android.os.Looper;
import android.os.Message;
import android.os.Process;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.core.app.ActivityCompat;
import androidx.core.app.NotificationCompat;
import androidx.core.app.NotificationManagerCompat;

public class MyService extends Service {
    private Looper serviceLooper;
    private ServiceHandler serviceHandler;

    private final class ServiceHandler extends Handler {
        public ServiceHandler(Looper looper) {
            super(looper);
        }

        @Override
        public void handleMessage(@NonNull Message msg) {
            try {
                Thread.sleep(3000);
            } catch (InterruptedException e) {
                Thread.currentThread().interrupt();
            }
            stopSelf(msg.arg1);
        }
    }

    @Override
    public void onCreate() {
        HandlerThread thread = new HandlerThread("ServiceStartArguments", Process.THREAD_PRIORITY_BACKGROUND);
        thread.start();
        serviceLooper = thread.getLooper();
        serviceHandler = new ServiceHandler(serviceLooper);

        showMyNotification("Service created.");
    }

    @Override
    public int onStartCommand(Intent intent, int flags, int startId) {
        Toast.makeText(this, "Service starting", Toast.LENGTH_SHORT).show();
        Message msg = serviceHandler.obtainMessage();
        msg.arg1 = startId;
        serviceHandler.sendMessage(msg);
        return START_STICKY;
    }

    @Override
    public void onDestroy() {
        Toast.makeText(this, "Service done", Toast.LENGTH_SHORT).show();
    }

    @Override
    public IBinder onBind(Intent intent) {
        return null;
    }

    @SuppressLint("ForegroundServiceType")
    private void showMyNotification(String message) {
        NotificationCompat.Builder builder = new NotificationCompat.Builder(
                this,
                "CHANNEL_ID")
                .setSmallIcon(android.R.drawable.stat_notify_more)
                .setContentTitle("Title")
                .setContentText(message)
                .setPriority(NotificationCompat.PRIORITY_DEFAULT);
        int notificationId = 1;
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            CharSequence name = "Channel name";
            int importance = NotificationManager.IMPORTANCE_DEFAULT;
            NotificationChannel channel = new NotificationChannel("CHANNEL_ID", name, importance);
            NotificationManager notificationManager =
                    getSystemService(NotificationManager.class);
            String description = "Channel description";
            channel.setDescription(description);
            notificationManager.createNotificationChannel(channel);
            notificationManager.notify(notificationId, builder.build());
        } else {
            NotificationManagerCompat notificationManager =
                    NotificationManagerCompat.from(this);
            if (ActivityCompat.checkSelfPermission(this, android.Manifest.permission.POST_NOTIFICATIONS) != PackageManager.PERMISSION_GRANTED) {
                return;
            }
            notificationManager.notify(notificationId, builder.build());
        }
        startForeground(1, builder.build());
    }
}