import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import 'TextPrefab.dart';

class CardPrefab {
  static Widget cradWithImageAndText(
      BuildContext context, String imageUrl, String text) {
    return Padding(
      padding: const EdgeInsets.all(16.0),
      child: Container(
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(20),
            boxShadow: const [
              BoxShadow(
                color: Colors.grey,
                blurRadius: 4,
                offset: Offset(4, 8), // Shadow position
              ),
            ],
          ),
          child: Column(children: [
            Padding(
              padding: const EdgeInsets.all(8.0),
              child: Container(
                  child: ClipRRect(
                borderRadius: BorderRadius.circular(20), // Image border
                child: SizedBox.fromSize(
                  // Image radius
                  child: Image.asset(imageUrl, fit: BoxFit.cover),
                ),
              )),
            ),
            Padding(
              padding: const EdgeInsets.all(10.0),
              child: TextPrefab.smallText(context, text),
            )
          ])),
    );
  }

  static Widget cradWithImageAndTextClickable(
      BuildContext context, String imageUrl, String text, Function() onPress) {
    return GestureDetector(
      onTap: onPress,
      child: Padding(
        padding: const EdgeInsets.only(bottom: 12.0, left: 12.0, right: 12.0),
        child: Container(
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(20),
            boxShadow: const [
              BoxShadow(
                color: Colors.grey,
                blurRadius: 4,
                offset: Offset(4, 8), // Shadow position
              ),
            ],
          ),
          child: Column(children: [
            Padding(
              padding: const EdgeInsets.all(8.0),
              child: Container(
                  child: ClipRRect(
                borderRadius: BorderRadius.circular(20), // Image border
                child: SizedBox.fromSize(
                  // Image radius
                  child: Image.asset(imageUrl, fit: BoxFit.cover),
                ),
              )),
            ),
            Padding(
              padding: const EdgeInsets.all(10.0),
              child: TextPrefab.smallText(context, text),
            )
          ]),
        ),
      ),
    );
  }
}
