package com.example.zylhq8_progkorny_bead1;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.stage.Stage;
import java.io.IOException;

public class FirstWindowApp extends Application {
    Stage stage;
    @Override
    public void start(Stage stage) throws IOException {
        this.stage = stage;
        FXMLLoader fxmlLoader = new FXMLLoader(FirstWindowApp.class.getResource("first-window.fxml"));
        Scene scene = new Scene(fxmlLoader.load(), 640, 480);
        FirstWindowController controller = fxmlLoader.getController();
        controller.application=this;
        stage.setTitle("ToDo Applikáció");
        stage.setMinWidth(350);
        stage.setMinHeight(200);
        stage.setScene(scene);
        stage.show();
    }
    public void Show() {
        stage.show();
    }
    public void Hide() {
        stage.hide();
    }
    public static void main(String[] args) {
        launch();
    }
}