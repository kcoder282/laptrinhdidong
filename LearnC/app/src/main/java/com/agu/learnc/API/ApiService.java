package com.agu.learnc.API;

import com.agu.learnc.Model.User;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface ApiService {
    Gson s = new GsonBuilder().setDateFormat("yyyy-MM-dd").create();
    ApiService api = new Retrofit.Builder().
            baseUrl("http://ltdd.atwebpages.com/api/")
            .addConverterFactory(GsonConverterFactory.create(s)).build().create(ApiService.class);
    @FormUrlEncoded
    @POST("login")
    Call<User> Login(@Field("username") String username, @Field("password") String password );
}
