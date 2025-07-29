<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions - EcoTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/legal-documents.css') }}" rel="stylesheet">
    <style>
        body.eco-bg {
            background: linear-gradient(135deg, #e3fcec 0%, #e0f2fe 100%) !important;
        }
        .eco-card {
            background: linear-gradient(135deg, #fff 60%, #e3fcec 100%);
            border: 2px solid #dcfce7;
            border-radius: 1.25rem;
            box-shadow: 0 2px 12px 0 rgba(31, 38, 135, 0.08);
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .eco-card:hover {
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            transform: translateY(-2px) scale(1.01);
        }
        @media (max-width: 640px) {
            .eco-card { padding: 0.5rem; }
        }
    </style>
</head>
<body class="eco-bg text-gray-900 font-sans">
    <!-- Back Button -->
    <div class="back-button">
        <a href="{{ url('/') }}" class="back-link">
            <svg class="back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Home
        </a>
    </div>

    <div class="container eco-card p-8 mt-8 mb-8">
        <h1>Ecotrack Terms and Conditions</h1>
        <p>Last updated: {{ now()->format("F j, Y") }}</p>
        
        <div class="legal-notice">
            PLEASE READ THESE TERMS AND CONDITIONS CAREFULLY. THIS IS A LEGALLY BINDING AGREEMENT BETWEEN YOU AND THE ENVIRONMENTAL AND NATURAL RESOURCES OFFICE (ENRO) OF ORMOC CITY.
        </div>

        <div class="section-content">
            <p class="paragraph">This Terms and Conditions Agreement ("Agreement") is entered into between the Environmental and Natural Resources Office (ENRO) of Ormoc City ("Service Provider," "we," "us," or "our") and the users of the EcoTrack system ("User," "you," or "your"). This Agreement governs your access to and use of the EcoTrack Automated Garbage Collection Scheduling & Tracking System with SMS Notification ("EcoTrack" or "the System"). By accessing or using the System, you acknowledge that you have read, understood, and agree to be bound by these terms and conditions in their entirety.</p>
        </div>

        <div class="numbered-section">
            <h2>1. Definitions and Interpretations</h2>
            <div class="section-content">
                <p class="paragraph">For the purposes of this Agreement, "EcoTrack" refers to the comprehensive waste management system developed and operated by ENRO Ormoc City, designed to automate and optimize garbage collection operations across the city. The Environmental and Natural Resources Office (ENRO) serves as the primary administrator and operator of the EcoTrack system, responsible for its maintenance, operation, and continuous improvement.</p>

                <p class="paragraph">The system recognizes three distinct user categories within its operational framework. ENRO Administrators are authorized personnel granted full system access and management capabilities, enabling them to oversee all aspects of the waste management operations. Barangay Officials, representing the 85 barangays within our jurisdiction, are provided with designated access levels appropriate to their roles in coordinating and monitoring waste collection activities within their respective areas. Residents, as individual users within the covered barangays, are granted access to essential features necessary for effective participation in the waste management program.</p>

                <p class="paragraph">The Service Area encompasses all 85 barangays of Ormoc City under ENRO's jurisdiction for waste management services. The System Features comprise a comprehensive suite of technological solutions, including but not limited to real-time GPS tracking of collection vehicles, automated scheduling systems, SMS notifications for updates and changes, digital reporting functionalities, and integrated waste management tools designed to optimize service delivery and enhance community participation.</p>
            </div>
        </div>

        <div class="numbered-section">
            <h2>2. Acceptance of Terms</h2>
            <div class="section-content">
                2.1. By accessing, registering for, or using any part of the EcoTrack system, you explicitly acknowledge that:
                
                <div class="subsection">
                    a) You have read, understood, and agree to be bound by all terms and conditions contained in this Agreement;
                    
                    b) You have the legal capacity and authority to enter into this Agreement;
                    
                    c) If you are a Barangay Official, you warrant that you have the authority to represent and bind your respective barangay to these terms;
                    
                    d) You consent to receive electronic communications from ENRO regarding service updates, maintenance notifications, and schedule changes.
                </div>

                2.2. If you do not agree with any part of these terms, you must immediately cease using the System and contact ENRO for proper resolution of any pending matters.
            </div>
        </div>

        <div class="numbered-section">
            <h2>3. System Access and Security</h2>
            <div class="section-content">
                3.1. Account Creation and Management:
                
                <div class="subsection">
                    a) ENRO will create and assign appropriate access levels based on user categories;
                    
                    b) You are responsible for maintaining the confidentiality of your account credentials;
                    
                    c) You must immediately notify ENRO of any unauthorized use of your account or other security breaches;
                    
                    d) ENRO reserves the right to suspend or terminate access if security violations are detected.
                </div>

                3.2. Authentication and Authorization:
                
                <div class="subsection">
                    a) Access to the System requires proper authentication through designated channels;
                    
                    b) Different user categories have specific access rights and restrictions as defined by ENRO;
                    
                    c) Attempts to exceed authorized access levels will be logged and may result in account suspension.
                </div>
            </div>
        </div>

        <div class="numbered-section">
            <h2>4. Service Description and Operational Framework</h2>
            <div class="section-content">
                4.1. Core System Components:
                
                <div class="subsection">
                    a) Fleet Management System:
                    - Real-time tracking of 14 functional garbage trucks
                    - Automated route optimization
                    - Vehicle maintenance scheduling and monitoring
                    - Digital inventory management
                    
                    b) Scheduling System:
                    - Automated assignment of 3-5 areas per truck daily
                    - Dynamic schedule adjustments based on operational needs
                    - Special scheduling for remote areas and emergency situations
                    
                    c) Communication Platform:
                    - SMS notification system for schedule updates
                    - Two-way communication between ENRO and stakeholders
                    - Automated alerts for collection times and changes
                    
                    d) Reporting and Analytics:
                    - Digital documentation of collection activities
                    - Performance metrics and route efficiency analysis
                    - Complaint tracking and resolution system
                </div>

                4.2. Service Coverage:
                
                <div class="subsection">
                    The System provides comprehensive waste management services across all 85 barangays of Ormoc City, with:
                    
                    a) Customized collection frequencies based on population density and waste volume;
                    
                    b) Special arrangements for remote areas with monthly collection schedules;
                    
                    c) Emergency response protocols for natural disasters and special circumstances;
                    
                    d) Coordination with DENR for environmental compliance and disaster response.
                </div>
            </div>
        </div>

        <div class="numbered-section">
            <h2>5. Rights and Obligations of Parties</h2>
            <div class="section-content">
                <p class="paragraph">ENRO, as the system administrator and service provider, maintains comprehensive responsibilities for system maintenance and operation. This includes ensuring consistent system availability and reliability, conducting regular maintenance and updates, providing responsive technical support, and maintaining robust data security and privacy standards. The organization is committed to maintaining the garbage collection fleet in optimal condition, implementing efficient collection routes, responding promptly to service disruptions, and continuously monitoring service quality and performance metrics.</p>

                <p class="paragraph">Communication forms a critical component of ENRO's obligations, encompassing the timely distribution of notifications regarding schedule changes, prompt responses to user inquiries and complaints, regular system updates and announcements, and the maintenance of open communication channels with all stakeholders. This commitment to transparent and effective communication ensures that all system users remain well-informed and supported throughout their interaction with the EcoTrack system.</p>

                <p class="paragraph">ENRO Administrators bear specific responsibilities including maintaining system integrity and security, ensuring timely updates to collection schedules, monitoring and optimizing route efficiency, responding to user feedback and issues, and ensuring compliance with all applicable environmental regulations. These responsibilities are crucial for the effective operation and continuous improvement of the EcoTrack system.</p>

                <p class="paragraph">Barangay Officials play a vital role in the system's success through their responsibilities to enforce waste management policies, maintain accurate resident information, coordinate effectively with ENRO for special needs, monitor collection activities in their respective areas, and report issues through appropriate channels. Their active participation and diligence in fulfilling these obligations are essential for the system's effectiveness at the community level.</p>

                <p class="paragraph">Residents, as end-users of the system, must adhere to proper waste segregation guidelines, follow established collection schedules, maintain updated contact information, report missed collections promptly, and cooperate fully with barangay officials. These obligations ensure the smooth operation of the waste management system and contribute to the overall environmental goals of the community.</p>
            </div>
        </div>

        <div class="numbered-section">
            <h2>6. Communication and Notifications</h2>
            <div class="section-content">
                <p class="paragraph">The SMS notification system serves as a fundamental component of EcoTrack, delivering critical updates including day-before collection reminders, same-day collection notifications, emergency schedule changes, and special announcements from ENRO. Users acknowledge that message and data rates may apply according to their mobile carrier's terms, and while the system strives to deliver notifications reliably, ENRO cannot guarantee delivery of SMS messages due to factors beyond our control.</p>

                <p class="paragraph">All system users provide their consent to receive automated notifications regarding collection schedules, schedule changes, and emergency updates. While users have the option to opt out of SMS notifications through the system settings, they acknowledge that doing so may impact their ability to receive timely updates about collection schedules and changes. ENRO strongly recommends maintaining active notification settings to ensure full awareness of service updates and changes.</p>
            </div>
        </div>

        <div class="numbered-section">
            <h2>7. Data Privacy and Protection</h2>
            <div class="section-content">
                <p class="paragraph">The EcoTrack system collects and processes various types of data necessary for effective service delivery. This includes personal identification information, contact details, location data from GPS tracking, system usage information, and service-related communication records. This data collection serves multiple purposes including service delivery optimization, route planning and efficiency improvements, communication facilitation, system enhancement and maintenance, and compliance with legal requirements.</p>

                <p class="paragraph">ENRO implements comprehensive data protection measures to ensure the security and privacy of all collected information. These measures include robust encryption of sensitive data, secure server infrastructure, regular security audits, stringent access control mechanisms, and reliable data backup and recovery systems. Our compliance framework adheres strictly to the Data Privacy Act of 2012 (RA 10173), incorporating regular privacy impact assessments, compliance reviews, and ongoing staff training in data protection practices.</p>
            </div>
        </div>

        <div class="numbered-section">
            <h2>8. System Maintenance and Updates</h2>
            <div class="section-content">
                <p class="paragraph">Regular system maintenance is conducted during scheduled windows during off-peak hours to minimize service disruption. Users receive advance notification regarding maintenance timing and duration, expected system impacts, and alternative procedures during downtime. ENRO maintains a strong commitment to minimizing service disruption during these necessary maintenance periods while ensuring system reliability and performance.</p>

                <p class="paragraph">In cases requiring emergency maintenance, such as security threats, system failures, critical updates, or emergency repairs, maintenance may be conducted without prior notice. However, ENRO commits to notifying users as soon as practicable regarding the nature of the emergency, expected duration of disruption, and any applicable alternative arrangements. This approach ensures both system security and service continuity while maintaining transparent communication with users.</p>
            </div>
        </div>

        <div class="numbered-section">
            <h2>9. Dispute Resolution</h2>
            <div class="section-content">
                <p class="paragraph">The dispute resolution process begins with an initial resolution phase where users must submit complaints through the system's designated channels. ENRO commits to responding within established timeframes and maintaining comprehensive documentation of all resolution attempts. For situations requiring further attention, a clear escalation procedure exists, involving appropriate authorities and culminating in final resolution by ENRO management when necessary.</p>

                <p class="paragraph">This Agreement operates under and is governed by the laws of the Republic of the Philippines, with specific reference to the Local Government Code, Environmental Laws, Data Privacy Act, and other applicable national and local regulations. This legal framework ensures proper governance and provides clear guidelines for resolving any disputes that may arise during system operation.</p>
            </div>
        </div>

        <div class="numbered-section">
            <h2>10. Term and Termination</h2>
            <div class="section-content">
                <p class="paragraph">This Agreement remains in effect throughout the duration of your use of the EcoTrack system, unless terminated earlier in accordance with these terms. Users may terminate their participation through voluntary discontinuation of system use or by submitting written notice to ENRO for account deletion. ENRO maintains the right to terminate user access in cases of terms violation, non-compliance with waste management protocols, security concerns or misuse, or operational necessity.</p>

                <p class="paragraph">Following termination, specific protocols govern data retention and deletion, final settlement of any pending matters, return or destruction of provided materials, and the continuation of applicable confidentiality obligations. These post-termination procedures ensure proper closure of the service relationship while maintaining data security and privacy standards.</p>
            </div>
        </div>

        <div class="numbered-section">
            <h2>11. Contact Information and Support</h2>
            <div class="section-content">
                <p class="paragraph">The Environmental and Natural Resources Office (ENRO), located at Aunubing Street, Barangay Cogon, Ormoc City, Leyte, Philippines, serves as the primary point of contact for all inquiries, support needs, and official communications regarding these terms and conditions. The office maintains dedicated channels for System Technical Support, Waste Collection Emergency Line, and the ENRO Operations Center, ensuring comprehensive support coverage for all system users.</p>

                <p class="paragraph">Regular operating hours are maintained Monday to Friday from 8:00 AM to 5:00 PM, with emergency support available 24/7 for critical situations. ENRO commits to specific response times for different types of inquiries: regular inquiries will receive responses within 24 hours, urgent matters within 4 hours, and emergency issues will receive immediate attention. This tiered response system ensures appropriate prioritization of user needs while maintaining efficient service delivery.</p>
            </div>
        </div>

        <div class="legal-notice">
            <p class="paragraph">By using the EcoTrack system, you acknowledge that you have read, understood, and agree to be bound by these Terms and Conditions. ENRO reserves the right to modify these terms at any time, with notice to users through the system's notification channels. Your continued use of the system following any modifications to these terms constitutes your acceptance of such changes.</p>
        </div>
    </div>
</body>
</html> 