package hu.jozsef.zylhq8_mobilprog2.Dependecy_Injection;

import androidx.lifecycle.MutableLiveData;
import androidx.lifecycle.ViewModel;

import javax.inject.Inject;

import dagger.hilt.android.lifecycle.HiltViewModel;

@HiltViewModel
public class TodoViewModel extends ViewModel {
    public MutableLiveData<TodoData> todoData;
    TodoRepository todoRepository;
    @Inject
    TodoViewModel(TodoRepository todoRepository){
        if(todoData == null) {
            todoData = new MutableLiveData<TodoData>();
        }
        this.todoRepository = todoRepository;
        for(TodoData td : todoRepository.todoDataList) {
            todoData.setValue(td);
        }
    }
    public MutableLiveData<TodoData> getTodoData() {
        return todoData;
    }
}
