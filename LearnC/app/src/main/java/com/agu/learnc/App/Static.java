package com.agu.learnc.App;

import android.content.SharedPreferences;

import androidx.fragment.app.Fragment;

import com.agu.learnc.App.Model.User;

public class Static {
    public static User user = null;
    public static boolean Return;
    public static Fragment content;
    public static String key;
    public static SharedPreferences sharedPreferences;
    public static void SetString(String key, String value)
    {
        if(sharedPreferences != null)
        {
            SharedPreferences.Editor edit = sharedPreferences.edit();
            edit.putString(key, value);
            edit.apply();
        }
    }
    public static String GetString(String key)
    {
        if(sharedPreferences != null)
        {
            return sharedPreferences.getString(key, null);
        }
        else return null;
    }
}
