package com.example.zylhq8_progkorny_bead1;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ListView;
import javafx.stage.Stage;

public class FirstWindowController{
    @FXML
    public FirstWindowApp application;
    public Button hozzaadasButton;
    public Button deleteButton;
    public Button editButton;
    static ObservableList<String> items = FXCollections.observableArrayList();
    public ListView<String> listView = new ListView<String>(items);

    public void initialize() {
        hozzaadasButton.setOnAction(this::hozzaadasButtonOnAction);
        deleteButton.setOnAction(this::deleteButtonOnAction);
        editButton.setOnAction(this::editButtonOnAction);
    }
    public void hozzaadasButtonOnAction(ActionEvent event) {
        application.Hide();
        try {
           SecondWindowApp secondApp = new SecondWindowApp();
           secondApp.start(new Stage());
           listView.getItems().add(secondApp.textFieldText);

        } catch (Exception ignored) {
        }
        application.Show();
    }
    public void deleteButtonOnAction(ActionEvent event) {
        ObservableList<String> selectedItems = listView.getSelectionModel().getSelectedItems();
        listView.getItems().removeAll(selectedItems);
    }
    public void editButtonOnAction(ActionEvent actionEvent){
        ObservableList<String> selectedItem = listView.getSelectionModel().getSelectedItems();
        application.Hide();
        try {
            SecondWindowApp secondApp = new SecondWindowApp();
            secondApp.textFieldText = selectedItem.get(0);
            secondApp.start(new Stage());
            listView.getItems().removeAll(selectedItem);
            listView.getItems().add(secondApp.textFieldText);
        } catch (Exception ignored) {
            Alert alert = new Alert(Alert.AlertType.ERROR, "No item selected!");
            alert.showAndWait();
        }
        application.Show();
    }
}