package hu.jozsef.zylhq8_mobilprog2.Views;

import static android.content.ContentValues.TAG;

import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.lifecycle.Observer;
import androidx.lifecycle.ViewModel;
import androidx.lifecycle.ViewModelProvider;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.room.Room;

import java.util.List;

import hu.jozsef.zylhq8_mobilprog2.Controllers.MainController;
import hu.jozsef.zylhq8_mobilprog2.Database.Word;
import hu.jozsef.zylhq8_mobilprog2.Database.WordDao;
import hu.jozsef.zylhq8_mobilprog2.Database.WordListAdapter;
import hu.jozsef.zylhq8_mobilprog2.Database.WordRoomDatabase;
import hu.jozsef.zylhq8_mobilprog2.Database.WordViewModel;
import hu.jozsef.zylhq8_mobilprog2.R;

public class RoomActivity extends AppCompatActivity {
    private WordViewModel mWordViewModel;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_room);

        EditText editText = findViewById(R.id.editTextWord);
        Button button = findViewById(R.id.buttonWord);

        RecyclerView recyclerView = findViewById(R.id.recyclerview);
        final WordListAdapter adapter = new WordListAdapter(this);
        recyclerView.setAdapter(adapter);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));

        mWordViewModel = new ViewModelProvider(this, new
                ViewModelProvider.Factory() {
                    @NonNull
                    @Override
                    public <T extends ViewModel> T create(@NonNull Class<T>
                                                                  modelClass) {
                        return (T) new WordViewModel(getApplication());
                    }
                }).get(WordViewModel.class);

        mWordViewModel.getAllWords().observe(this, new Observer<List<Word>>() {
            @Override
            public void onChanged(@Nullable final List<Word> words) {
                adapter.setWords(words);
            }
        });

        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Word word = new Word(editText.getText().toString());
                mWordViewModel.insert(word);
            }
        });
    }
}
