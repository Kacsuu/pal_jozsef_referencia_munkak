package com.example.zylhq8_progkorny_bead1;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.stage.Stage;

public class SecondWindowApp extends Application {
    public String textFieldText;

    public static void main(String[] args) {
        launch(args);
    }

    @Override
    public void start(Stage stage) throws Exception {
        FXMLLoader fxmlLoader = new FXMLLoader(SecondWindowApp.class.getResource("second-window.fxml"));
        Scene scene = new Scene(fxmlLoader.load());
        SecondWindowController controller = fxmlLoader.getController();
        stage.setTitle("Teendő hozzáadása");
        stage.setMinWidth(320);
        stage.setMinHeight(160);
        stage.setMaxWidth(320);
        stage.setMaxHeight(160);
        stage.setScene(scene);
        controller.stage=stage;
        controller.textField.setText(textFieldText);
        stage.showAndWait();

        textFieldText = controller.textField.getText();

    }



}
