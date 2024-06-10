package hu.jozsef.zylhq8_mobilprog2.WorkManager;

import android.content.Context;

import androidx.annotation.NonNull;
import androidx.work.Worker;
import androidx.work.WorkerParameters;

public class WaitWorker extends Worker {
    Context mContext;
    public WaitWorker(@NonNull Context context,
                      @NonNull WorkerParameters workerParams) {
        super(context, workerParams);
        mContext = context;
    }
    @NonNull
    @Override
    public Result doWork() {
        try {
            Thread.sleep( 3000 );
        } catch (InterruptedException e) {
            return Result.failure();
        }
        return Result.success();
    }
}
