package hu.jozsef.zylhq8_mobilprog2.Views;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;
import androidx.lifecycle.Observer;
import androidx.work.Constraints;
import androidx.work.Data;
import androidx.work.OneTimeWorkRequest;
import androidx.work.WorkContinuation;
import androidx.work.WorkInfo;
import androidx.work.WorkManager;

import hu.jozsef.zylhq8_mobilprog2.R;
import hu.jozsef.zylhq8_mobilprog2.WorkManager.MyWorker;
import hu.jozsef.zylhq8_mobilprog2.WorkManager.WaitWorker;

public class WorkManagerActivity extends AppCompatActivity {
    private WorkManager mWorkManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_work_manager);

        final OneTimeWorkRequest waitRequest = new OneTimeWorkRequest.Builder(WaitWorker.class).build();

        Constraints constraints = new Constraints.Builder().setRequiresBatteryNotLow(true).build();
        Data inputData = new Data.Builder().putString("data", "Hello from WorkManager!").build();
        final OneTimeWorkRequest mRequest = new OneTimeWorkRequest.Builder(MyWorker.class).setConstraints( constraints ).setInputData( inputData ).build();

        TextView textView = findViewById(R.id.textViewWorkManager);
        Button buttonWorkManager = findViewById(R.id.buttonWorkManager);

        mWorkManager = WorkManager.getInstance( this );

        buttonWorkManager.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //mWorkManager.enqueue( mRequest );

                WorkContinuation continuation = mWorkManager.beginWith(waitRequest);
                continuation.then(mRequest).enqueue();

            }
        });

        mWorkManager.getWorkInfoByIdLiveData( mRequest.getId() ).observe(this,
                new Observer<WorkInfo>() {
                    @Override
                    public void onChanged(WorkInfo workInfo) {
                        if (workInfo != null) {
                            WorkInfo.State state = workInfo.getState();
                            textView.setText(state.toString() +
                                    ", " +
                                    workInfo.getOutputData().getString("result") );
                        }
                    }
                });
    }

}
