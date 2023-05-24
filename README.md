# NCMR-Approval-System
NCMR Approval Workflow System (10 Stage Customized Approval Process)
- This system is build using PHP,HTML,CSS,JS,AJAX,JQUERY,SQL.
- This system was developed from scratch.

# Summary
- This is a Non-Conforming Material Report(NCMR) Approval System which consists of 10 different stages of approvals.
- Each stage will be NOTIFIED to the respective Approver via email.
- The Approver for each stage will be choosen by the Form Issuer during Form issuing process.
- All the Approvers either can APPROVE or REJECT the Form with comments.
- After each of the successful process, the next Approver in the workflow will be notified immediately via email.
- Issuer can UPLOAD the Material photos inside the form.
- This NCMR Form records Date & Signature of each of the Approver.
- After all the approval process, system will notify the Issuer to CLOSE the form.

# Admin Role
- Admin can CREATE, EDIT, DELETE users in this system.
- Admin can assign roles as 'user' or 'approver' and access as 'user' or 'admin'.

# User Role
- General User can VIEW the list of 'Pending' & 'Closed' NCMR Forms.
- User can DOWNLOAD the form in PDF.
- User can CREATE New NCMR Form.
- User can MANAGE their own profile under settings.
- User can also GENERATE Report for custom dates and EXPORT TO EXCEL.
- User can VIEW simple Dashboard created using Chart.js

# Approver
- Approver can VIEW list of Pending Approvals with status.
- Approver can 'APPROVE' or 'REJECT' the Form.
- Approver can UPLOAD Pictures or ADD Comments during the approval.

# DB
- Find SQL file 'DB' and Import to phpmyadmin.
- Database name should be 'ncmr'
- This db only consists of 3 tables, 'form', 'user', 'scrap_cost'
