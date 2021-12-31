package com.agu.learnc.Api;

import com.agu.learnc.App.Model.User;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.Query;

public interface ApiManager {
    Gson gson = new GsonBuilder().setDateFormat("yyyy-MM-dd").create();
    ApiManager call = new Retrofit.Builder()
            .baseUrl("http://ltdd.atwebpages.com/api/")
            .addConverterFactory(GsonConverterFactory.create(gson))
            .build().create(ApiManager.class);
    @FormUrlEncoded
    @POST ("login")
    Call<User> Login(@Field("username") String username, @Field("password") String password);

    @GET("auth")
    Call<User> GetUser(@Query("key") String key);
}
