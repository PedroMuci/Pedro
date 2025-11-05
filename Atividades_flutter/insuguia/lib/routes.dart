import 'package:flutter/material.dart';
import 'screens/home_screen.dart';
import 'screens/patient_form_screen.dart';
import 'screens/patient_list_screen.dart';
import 'screens/follow_up_screen.dart';
import 'screens/about_screen.dart';

final Map<String, WidgetBuilder> appRoutes = {
  '/': (context) => const HomeScreen(),
  '/patient-form': (context) => const PatientFormScreen(),
  '/patient-list': (context) => const PatientListScreen(),
  '/follow-up': (context) => const FollowUpScreen(),
  '/about': (context) => const AboutScreen(),
};
