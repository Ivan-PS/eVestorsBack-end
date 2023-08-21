import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../Utils/DefaultColors.dart';

class ButtonPrefab {
  static Widget defaultButton(String text, Function() onPress) {
    return SizedBox(
      height: 40,
      child: GestureDetector(
        onTap: onPress,
        child: Container(
            decoration: BoxDecoration(
              border: Border.all(color: DefaultColors.primary),
              borderRadius: BorderRadius.all(Radius.circular(10)),
              color: DefaultColors.primary,
            ),
            child: Center(
                child: Text(
              text,
              textAlign: TextAlign.center,
              style: TextStyle(
                  color: DefaultColors.white, fontWeight: FontWeight.bold),
            ))),
      ),
    );
  }

  static Widget defaultRoundButton(String text, Function() onPress) {
    return SizedBox(
      height: 40,
      child: GestureDetector(
        onTap: onPress,
        child: Container(
            decoration: BoxDecoration(
              border: Border.all(color: DefaultColors.primary),
              borderRadius: BorderRadius.all(Radius.circular(20)),
              color: DefaultColors.primary,
            ),
            child: Center(
                child: Text(
              text,
              textAlign: TextAlign.center,
              style: TextStyle(
                  color: DefaultColors.white, fontWeight: FontWeight.bold),
            ))),
      ),
    );
  }

  static Widget defaultIconButton(Widget icon, Function() onPress) {
    return Container(
        child: Padding(
      padding: const EdgeInsets.all(12.0),
      child: GestureDetector(
        onTap: onPress,
        child: icon,
      ),
    ));
  }
}
