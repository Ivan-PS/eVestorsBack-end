import 'package:evestors/Utils/DefaultColors.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';

class InputTextPrefab {
  static Widget defaultInputText(
      String placeholder, TextEditingController controller) {
    return TextField(
        controller: controller,
        decoration: InputDecoration(
            hintText: placeholder,
            focusedBorder: OutlineInputBorder(
              borderSide: BorderSide(width: 2, color: DefaultColors.primary),
              borderRadius: BorderRadius.circular(5.0),
            ),
            border: OutlineInputBorder(
              borderSide: BorderSide(width: 2, color: DefaultColors.black),
              borderRadius: BorderRadius.circular(5.0),
            )));
  }

  static Widget defaultInputMultiLineText(
      String placeholder, TextEditingController controller) {
    return TextField(
        maxLines: null,
        minLines: 5,
        keyboardType: TextInputType.multiline,
        controller: controller,
        decoration: InputDecoration(
            hintText: placeholder,
            focusedBorder: OutlineInputBorder(
              borderSide: BorderSide(width: 2, color: DefaultColors.primary),
              borderRadius: BorderRadius.circular(5.0),
            ),
            border: OutlineInputBorder(
              borderSide: BorderSide(width: 2, color: DefaultColors.black),
              borderRadius: BorderRadius.circular(5.0),
            )));
  }

  static Widget defaultInputPasswordText(
      String placeholder, TextEditingController controller) {
    return TextField(
        controller: controller,
        obscureText: true,
        decoration: InputDecoration(
            hintText: placeholder,
            focusedBorder: OutlineInputBorder(
              borderSide: BorderSide(width: 2, color: DefaultColors.primary),
              borderRadius: BorderRadius.circular(5.0),
            ),
            border: OutlineInputBorder(
              borderSide: BorderSide(width: 2, color: DefaultColors.black),
              borderRadius: BorderRadius.circular(5.0),
            )));
  }

  static Widget defaultInputNumberPhone(String placeholder) {
    return TextField(
      decoration: InputDecoration(
          hintText: placeholder,
          focusedBorder: OutlineInputBorder(
            borderSide: BorderSide(width: 2, color: DefaultColors.primary),
            borderRadius: BorderRadius.circular(5.0),
          ),
          border: OutlineInputBorder(
            borderSide: BorderSide(width: 2, color: DefaultColors.black),
            borderRadius: BorderRadius.circular(5.0),
          )),
      keyboardType: TextInputType.number,
      inputFormatters: <TextInputFormatter>[
        FilteringTextInputFormatter.digitsOnly
      ],
    );
  }
}
