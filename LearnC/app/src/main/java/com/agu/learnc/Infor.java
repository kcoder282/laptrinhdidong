package com.agu.learnc;

import android.app.Fragment;
import android.os.Bundle;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.RadioGroup;


public class Infor extends Fragment {
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view =  inflater.inflate(R.layout.fm_user_infor, container, false);
        if(MainActivity.user != null)
        {
            ((EditText)view.findViewById(R.id.fullname)).setText(MainActivity.user.getFullname());
            ((EditText)view.findViewById(R.id.bird)).setText(MainActivity.user.getBird());
            ((EditText)view.findViewById(R.id.email)).setText(MainActivity.user.getEmail());
            ((RadioGroup)view.findViewById(R.id.sex)).check((MainActivity.user.getSex()==1?R.id.sex_male:R.id.sex_Female));
        }

        return view;
    }
}