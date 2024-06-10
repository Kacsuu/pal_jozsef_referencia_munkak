package com.example.zylhq8_progkorny_bead1;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.stage.Stage;

public class SecondWindowController {
    @FXML
    public void initialize() {
        mentesButton.setOnAction(this::mentesButtonOnAction);
    }

    public TextField textField;
    public Button mentesButton;
    Stage stage;
    public void mentesButtonOnAction(ActionEvent actionEvent) {
            stage.close();
    }
}
