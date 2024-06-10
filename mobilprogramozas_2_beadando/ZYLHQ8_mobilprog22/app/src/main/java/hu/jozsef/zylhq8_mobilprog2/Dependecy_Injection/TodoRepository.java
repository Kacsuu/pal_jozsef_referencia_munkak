package hu.jozsef.zylhq8_mobilprog2.Dependecy_Injection;

import java.util.ArrayList;
import java.util.List;

import javax.inject.Inject;

public class TodoRepository {
    public List<TodoData> todoDataList;
    @Inject
    TodoRepository(){
        todoDataList = new ArrayList<>();
        todoDataList.add(new TodoData("Hello"));
        todoDataList.add(new TodoData("World"));
    }
}
