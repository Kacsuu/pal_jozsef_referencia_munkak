package hu.jozsef.zylhq8_mobilprog2.WorkManager;

import android.Manifest;
import android.annotation.SuppressLint;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.content.Context;
import android.content.pm.PackageManager;
import android.os.Build;

import androidx.annotation.NonNull;
import androidx.core.app.ActivityCompat;
import androidx.core.app.NotificationCompat;
import androidx.core.app.NotificationManagerCompat;
import androidx.work.Data;
import androidx.work.Worker;
import androidx.work.WorkerParameters;

import hu.jozsef.zylhq8_mobilprog2.R;

public class MyWorker extends Worker {
    Context mContext;
    private static final String CHANNEL_ID = "My Channel";

    public MyWorker(@NonNull Context context,
                    @NonNull WorkerParameters workerParams) {
        super(context, workerParams);
        mContext = context;
    }

    @NonNull
    @Override
    public Result doWork() {
        Data data = getInputData();
        String message = data.getString("data");
        Data outputData =
                new Data.Builder().putString("result", "Work finished!").build();
        showMyNotification(message);
        return Result.success(outputData);
    }

    @SuppressLint("MissingPermission")
    private void showMyNotification(String message) {
        NotificationCompat.Builder builder = new NotificationCompat.Builder(mContext,
                CHANNEL_ID)
                .setSmallIcon(R.drawable.baseline_sentiment_satisfied_alt_24)
                .setContentTitle("Work Manager Notification")
                .setContentText(message)
                .setPriority(NotificationCompat.PRIORITY_DEFAULT);
        int notificationId = 1;
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            CharSequence name = "Channel name";
            int importance = NotificationManager.IMPORTANCE_DEFAULT;
            NotificationChannel channel =
                    new NotificationChannel(CHANNEL_ID, name, importance);
            NotificationManager notificationManager =
                    mContext.getSystemService(NotificationManager.class);
            String description = "Channel description";
            channel.setDescription(description);
            notificationManager.createNotificationChannel(channel);
            notificationManager.notify(notificationId, builder.build());
        } else {
            NotificationManagerCompat notificationManager =
                    NotificationManagerCompat.from(mContext);
            notificationManager.notify(notificationId, builder.build());
        }
    }
}
