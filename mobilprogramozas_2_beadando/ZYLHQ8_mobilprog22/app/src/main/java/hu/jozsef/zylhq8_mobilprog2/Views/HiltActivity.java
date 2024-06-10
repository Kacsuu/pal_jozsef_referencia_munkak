package hu.jozsef.zylhq8_mobilprog2.Views;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;
import androidx.lifecycle.Observer;
import androidx.lifecycle.ViewModelProvider;

import dagger.hilt.android.AndroidEntryPoint;
import hu.jozsef.zylhq8_mobilprog2.Controllers.MainController;
import hu.jozsef.zylhq8_mobilprog2.Dependecy_Injection.TodoData;
import hu.jozsef.zylhq8_mobilprog2.Dependecy_Injection.TodoViewModel;
import hu.jozsef.zylhq8_mobilprog2.R;

@AndroidEntryPoint
public class HiltActivity extends AppCompatActivity {
    public TodoViewModel todoViewModel;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_hilt);

        final TextView textView = findViewById(R.id.textViewTodo);
        final EditText editText = findViewById(R.id.editTextTodo);
        Button button = findViewById(R.id.buttonTodo);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String todo = editText.getText().toString();
                todoViewModel. getTodoData().setValue( new TodoData(todo));
            }
        });

        todoViewModel = new ViewModelProvider(this).get(TodoViewModel.class);

        final Observer<TodoData> todoObserver = new Observer<TodoData>() {
            @Override
            public void onChanged(TodoData todoData) {
                textView.setText( todoData.todo );
            }
        };

        todoViewModel. getTodoData().observe(this, todoObserver);
    }
}
