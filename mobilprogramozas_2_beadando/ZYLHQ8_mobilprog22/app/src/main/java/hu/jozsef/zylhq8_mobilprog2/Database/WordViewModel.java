package hu.jozsef.zylhq8_mobilprog2.Database;

import android.app.Application;

import androidx.annotation.NonNull;
import androidx.lifecycle.AndroidViewModel;
import androidx.lifecycle.LiveData;

import java.util.List;

public class WordViewModel extends AndroidViewModel {

    private LiveData<List<Word>> mAllWords;
    private WordRepository mRepository;
    public WordViewModel(@NonNull Application application) {
        super(application);
        mRepository = new WordRepository(application);
        mAllWords = mRepository.getAllWords();
    }

    public LiveData<List<Word>> getAllWords() { return mAllWords; }
    public void insert(Word word) { mRepository.insert(word); }
}
