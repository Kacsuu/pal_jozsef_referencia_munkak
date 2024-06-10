package com.example.zylhq8mobilprogbeadando;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class ChangePasswordActivity extends AppCompatActivity {
    EditText oldPassword, oldPasswordAgain, newPassword, newPasswordAgain;
    Button btnChangePassword, btnDeleteUser;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_change_password);

        btnChangePassword = (Button) findViewById(R.id.btnChangePassword);
        btnDeleteUser = (Button) findViewById(R.id.btnDeleteUser);

        oldPassword = (EditText) findViewById(R.id.oldPassword);
        oldPasswordAgain = (EditText) findViewById(R.id.oldPasswordAgain);
        newPassword = (EditText) findViewById(R.id.newPassword);
        newPasswordAgain = (EditText) findViewById(R.id.newPasswordAgain);
        SharedPreferences sharedPreferences = getSharedPreferences("password", MODE_PRIVATE);

        DBHelper dbHelper = new DBHelper(this);

        btnChangePassword.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
               if(oldPassword.getText().toString().equals(sharedPreferences.getString("password", "").toString())
                       && oldPasswordAgain.getText().toString().equals(sharedPreferences.getString("password", "").toString())
                       && newPassword.getText().toString().equals(newPasswordAgain.getText().toString())) {
                            String username = sharedPreferences.getString("username","").toString();
                            dbHelper.changePassword(username, newPassword.getText().toString());
                            Toast.makeText(ChangePasswordActivity.this, "Sikeres jelszóváltoztatás!", Toast.LENGTH_SHORT).show();
                            finish();
               }
               else{
                   Toast.makeText(ChangePasswordActivity.this, "Helytelen adatok!", Toast.LENGTH_SHORT).show();
               }
            }
        });

        btnDeleteUser.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder builder = new AlertDialog.Builder(ChangePasswordActivity.this);
                builder.setMessage("Biztosan törlöd a fiókod?").setPositiveButton("Igen", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        dbHelper.deleteUser(sharedPreferences.getString("username", ""));
                        Toast.makeText(ChangePasswordActivity.this, "Felhasználó törölve!", Toast.LENGTH_SHORT).show();
                        Intent intent  = new Intent(getApplicationContext(), MainActivity.class);
                        startActivity(intent);
                    }
                }).setNegativeButton("Nem", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {

                    }
                });
                builder.create().show();
            }
        });
    }
}